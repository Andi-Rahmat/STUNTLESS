<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChatGPT x Laravel</title>
    <style>
        body {
            font-family: system-ui, sans-serif;
            max-width: 720px;
            margin: 32px auto;
        }

        textarea {
            width: 100%;
            height: 120px;
        }

        pre {
            background: #111;
            color: #eee;
            padding: 12px;
            white-space: pre-wrap;
            border-radius: 8px;
        }

        .row {
            display: flex;
            gap: 8px;
            margin: 8px 0;
        }

        button {
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>ChatGPT x Laravel</h1>
    <textarea id="prompt" placeholder="Tulis pertanyaanmu..."></textarea>
    <div class="row">
        <button id="send">Kirim (non-stream)</button>
        <button id="sendStream">Kirim (stream)</button>
    </div>
    <h3>Balasan</h3>
    <pre id="out"></pre>

    <script>
        const out = document.getElementById('out');
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.getElementById('send').onclick = async () => {
            out.textContent = '…';
            const prompt = document.getElementById('prompt').value;
            const res = await fetch('/api/chat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({
                    prompt
                })
            });
            const data = await res.json();
            out.textContent = data.reply || JSON.stringify(data, null, 2);
        };

        document.getElementById('sendStream').onclick = async () => {
            out.textContent = '';
            const prompt = document.getElementById('prompt').value;
            const res = await fetch('/api/chat/stream', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf
                },
                body: JSON.stringify({
                    prompt
                })
            });

            // Baca SSE (ReadableStream)
            const reader = res.body.getReader();
            const decoder = new TextDecoder('utf-8');
            let buffer = '';

            while (true) {
                const {
                    value,
                    done
                } = await reader.read();
                if (done) break;

                buffer += decoder.decode(value, {
                    stream: true
                });
                const events = buffer.split('\n\n');
                buffer = events.pop() || '';

                for (const evt of events) {
                    const line = evt.trim();
                    if (!line.startsWith('data:')) continue;
                    const json = line.replace(/^data:\s?/, '').trim();
                    if (json === '[DONE]') return;

                    try {
                        const obj = JSON.parse(json);

                        // Responses API mengirim event delta teks seperti ini:
                        // { "type":"response.output_text.delta", "delta":"..." }
                        if (obj.type === 'response.output_text.delta' && obj.delta) {
                            out.textContent += obj.delta;
                        }

                        // Saat selesai:
                        // { "type":"response.completed" }
                    } catch (e) {
                        // abaikan chunk non-JSON
                    }
                }
            }
        };
    </script>
</body>

</html>