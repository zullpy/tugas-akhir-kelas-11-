<?php
include "koneksi.php"; // sesuaikan path koneksi kamu

$token = "RCSzbC6GW6r1peaAeq8E";
$denda_per_hari = 5000;

$query = "
SELECT *,
DATEDIFF(CURDATE(), tanggal_kembali) as selisih
FROM peminjaman
WHERE status = 'dipinjam'
AND (last_notif_date IS NULL OR last_notif_date != CURDATE())
";

$result = mysqli_query($koneksi, $query);

while ($row = mysqli_fetch_assoc($result)) {

    $no_wa = preg_replace('/^0/', '62', $row['no_wa']);
    $tanggal_kembali = $row['tanggal_kembali'];
    $selisih = $row['selisih'];

    $message = "";

    // ======================
    // H-1 (Besok jatuh tempo)
    // ======================
    if ($selisih == -1) {
        $message = "📚 Pengingat Pengembalian
        Besok adalah batas pengembalian buku.
        Tanggal: $tanggal_kembali
        Mohon dikembalikan tepat waktu 🙏";
    }

    // ======================
    // H+1 dan seterusnya (Telat)
    // ======================
    else if ($selisih > 0) {
        $total_denda = $selisih * $denda_per_hari;
        $message = "🚨 Terlambat Mengembalikan Buku
        Kamu terlambat $selisih hari.
        Denda berjalan: Rp " . number_format($total_denda,0,',','.') . "
        Segera kembalikan buku untuk menghentikan denda 🙏";
    }

    // ======================
    // Kirim jika ada pesan
    // ======================
    if ($message != "") {

        $data = [
            'target' => $no_wa,
            'message' => $message,
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.fonnte.com/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => array(
                "Authorization: $token"
            ),
        ));

        curl_exec($curl);
        curl_close($curl);

        mysqli_query($koneksi, "UPDATE peminjaman 
                             SET last_notif_date = CURDATE() 
                             WHERE id_peminjaman = ".$row['id_peminjaman']);
    }
}

echo "Notifikasi diproses.";
?>