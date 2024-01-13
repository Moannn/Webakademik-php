<?php
    include "../config/db_connection.php";
    include "ipk.php";

    $sql = "SELECT * FROM nilai AS n
            INNER JOIN mahasiswa AS m ON m.NIM = ".$_SESSION['nim']." AND m.NIM = n.NIM
            INNER JOIN mata_kuliah AS mk ON mk.ID_Matkul = n.ID_Matkul
            ORDER BY mk.Semester";

    $result = mysqli_query($conn, $sql);

    $ipk = countIPK($result);

    $arr_hari = array("Ahada","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
    $id_hari = date('w');

    $hari = "'".$arr_hari[$id_hari]."'";

    $sql = "SELECT * FROM nilai AS n
            INNER JOIN jadwal AS j ON n.NIM = ".$_SESSION['nim']." AND n.ID_Matkul = j.ID_Matkul AND j.Hari = ".$hari."
            INNER JOIN mata_kuliah AS mk ON j.ID_Matkul = mk.ID_Matkul
            INNER JOIN mengajar AS m ON mk.ID_Matkul = m.ID_Matkul
            INNER JOIN dosen AS d ON d.ID_Dosen = m.ID_Dosen
            INNER JOIN ruangan AS r ON r.ID_Ruangan = j.ID_Ruangan
            
            ORDER BY j.Jam_Masuk";
    
    $result = mysqli_query($conn, $sql);
?>

<div class="info">
    <div class="left-item">
        <i class="fa fa-graduation-cap" aria-hidden="true"></i> IPK : <?php echo $ipk[0];?>
    </div>
    <div class="right-item">
    <i class="fa fa-book" aria-hidden="true"></i> Jumlah SKS : <?php echo $ipk[1];?>
    </div>
</div>

<div class="tabel-page">
    <div class="tabel-heading">
        Jadwal Kuliah Hari ini
    </div>
    <table id="list-data" class="display">
        <thead>
            <tr>
                <th>
                    <h5>Dosen</h5>
                </th>
                <th>
                    <h5>Mata Kuliah</h5>
                </th>
                <th>
                    <h5>Ruangan</h5>
                </th>
                <th>
                    <h5>Waktu</h5>
                </th>
            </tr>
        </thead>
        <?php
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $row["Nama_Dosen"];?></td>
                <td><?php echo $row["Nama_Matkul"];?></td>
                <td><?php echo $row["Nama_Ruangan"];?></td>
                <td><?php echo $row["Jam_Masuk"]."-".$row["Jam_Keluar"];?></td>
            </tr>
        <?php
                }
            }
            mysqli_close($conn);
        ?>
    </table>
</div>