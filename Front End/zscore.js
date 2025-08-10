function klasifikasi() {
  const berat = parseFloat(document.getElementById("berat").value);
  const tinggi = parseFloat(document.getElementById("tinggi").value);
  const umur = parseInt(document.getElementById("umur").value);
  const jk = document.getElementById("jk").value;

  const referensi = {
    L: { M: 12.2, SD: 1.1 },
    P: { M: 11.5, SD: 1.0 },
  };

  let M = referensi[jk].M;
  let SD = referensi[jk].SD;
  let z = (berat - M) / SD;

  let status = "";
  if (z < -3) status = "Gizi Buruk";
  else if (z >= -3 && z < -2) status = "Gizi Kurang";
  else if (z >= -2 && z <= 2) status = "Gizi Normal";
  else status = "Gizi Lebih";

  document.getElementById("hasil-zscore").innerHTML = `Z-score: ${z.toFixed(
    2
  )}`;

  // Menampilkan hasil Status Gizi
  document.getElementById(
    "hasil-gizi "
  ).innerHTML = `Status Gizi: <strong>${status}</strong>`;
}
