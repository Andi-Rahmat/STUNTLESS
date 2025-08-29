import java.awt.event.*;
import javax.swing.*;

public class coba extends JFrame {
    private JTextField txtBilangan, txtBasis;
    private JButton btnKonversi;
    private JLabel lblHasil;

    public coba() {
        setTitle("Konversi Bilangan ke Desimal");
        setSize(400, 200);
        setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        setLayout(null);

        JLabel lbl1 = new JLabel("Masukkan Bilangan:");
        lbl1.setBounds(20, 20, 150, 25);
        add(lbl1);

        txtBilangan = new JTextField();
        txtBilangan.setBounds(180, 20, 150, 25);
        add(txtBilangan);

        JLabel lbl2 = new JLabel("Basis (n):");
        lbl2.setBounds(20, 60, 150, 25);
        add(lbl2);

        txtBasis = new JTextField();
        txtBasis.setBounds(180, 60, 150, 25);
        add(txtBasis);

        btnKonversi = new JButton("Konversi");
        btnKonversi.setBounds(20, 100, 100, 30);
        add(btnKonversi);

        lblHasil = new JLabel("Hasil dalam bentuk desimal: ");
        lblHasil.setBounds(150, 100, 250, 30);
        add(lblHasil);

        // Aksi tombol konversi
        btnKonversi.addActionListener(new ActionListener() {
        
            public void actionPerformed(ActionEvent e) {
                String bilangan = txtBilangan.getText();
                int basis = Integer.parseInt(txtBasis.getText());

                int hasil = 0;
                for (int i = 0; i < bilangan.length(); i++) {
                    int digit = Character.getNumericValue(bilangan.charAt(i));
                    hasil = hasil * basis + digit;
                }

                lblHasil.setText("Hasil: " + hasil);
            }
        });
    }

    public static void main(String[] args) {
        SwingUtilities.invokeLater(() -> {
            new coba().setVisible(true);
        });
    }
}
