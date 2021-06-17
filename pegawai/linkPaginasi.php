        <?php if ($halAktif > 1) : ?>
            <a href="?halaman=<?= $halAktif - 1; ?>">&laquo;</a>
        <?php endif; ?>

        <?php for ($j = 1; $j <= $jmlHalaman; $j++) : ?>
            <?php if ($j == $halAktif) : ?>
                <a href="?halaman=<?= $j; ?>" style="font-weight: bold; color: red;"> <?= $j; ?></a>
            <?php else : ?>
                <a href="?halaman=<?= $j; ?>"> <?= $j; ?></a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($halAktif < $jmlHalaman) : ?>
            <a href="?halaman=<?= $halAktif + 1; ?>">&raquo;</a>
        <?php endif; ?>