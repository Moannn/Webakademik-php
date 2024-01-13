<div class="tabel-page">
    <div class="tabel-heading">
        Daftar Dosen yang Mengajar
    </div>
    <table id="list-data" class="display">
        <thead>
            <tr>
                <th>
                    <h5>ID Dosen</h5>
                </th>
                <th>
                    <h5>Nama Dosen</h5>
                </th>
            </tr>
        </thead>
        <?php
            include "../config/db_connection.php";

            $sql = "SELECT * FROM dosen AS d
                    INNER JOIN mengajar AS me ON d.ID_Dosen = me.ID_Dosen
                    INNER JOIN nilai AS n ON me.ID_Matkul = n.ID_Matkul AND n.NIM = ".$_SESSION['nim'];
            
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $row["ID_Dosen"];?></td>
                <td><?php echo $row["Nama_Dosen"];?></td>
            </tr>
        <?php
                }
            }
            mysqli_close($conn);
        ?>
    </table>
</div>