<h1>Hello World</h1>

<?php var_dump($postes);?>
    <section class="postes">
        <div class="postes-list">
            <?php foreach ($postes as $poste) : ?> {
                <div class="card">
                    <h2><?= $poste->titre; ?></h2>
                </div>
            <?php endforeach ?>
            }
        </div>
    </section>