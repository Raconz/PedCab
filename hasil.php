<?php include("partial/header.php");

$penyakit = $koneksi->query('SELECT * FROM penyakit')->fetchAll(PDO::FETCH_OBJ);
$relasi = $koneksi->query('SELECT * FROM relasi')->fetchAll(PDO::FETCH_OBJ); 
$gej = $koneksi->query('SELECT id_gejala, kode_gejala, belief FROM gejala')->fetchAll(PDO::FETCH_OBJ);
?>
<!--hasil-->
<section id="hasil" class="section-padding">
<?php include("partial/navUser.php");?>
<div class="container" style="margin-top: 50px;">
    <?php class DempsterShaferDiagnosis {
        private $diseases;
        private $symptomWeights;

        public function __construct($diseases, $symptomWeights) {
            $this->diseases = $diseases;
            $this->symptomWeights = $symptomWeights;
        }

        public function diagnose($userSymptoms) {
            $beliefs = [];

            // Calculate belief for each disease based on user symptoms
            foreach ($this->diseases as $disease => $symptoms) {
                $belief = 1;

                foreach ($userSymptoms as $symptom) {
                    if (in_array($symptom, $symptoms)) {
                        $belief *= $this->symptomWeights[$symptom];
                    } else {
                        $belief *= (1 - $this->symptomWeights[$symptom]);
                    }
                }

                $beliefs[$disease] = $belief;
            }

            // Normalize beliefs
            $totalBelief = array_sum($beliefs);
            foreach ($beliefs as $disease => $belief) {
                $beliefs[$disease] = $belief / $totalBelief;
            }

            return $beliefs;
        }
    }

    // Define diseases and their symptoms
    //$diseases = [
    //    'P1' => ['G1', 'G2', 'G4', 'G9'],
    //    'P2' => ['G3', 'G5', 'G6'],
    //    'P3' => ['G1', 'G2', 'G4', 'G5', 'G7'],
    //    'P4' => ['G3', 'G5', 'G6'],
    //    'P5' => ['G3', 'G5', 'G8', 'G9'],
    //    'P6' => ['G1', 'G8', 'G10']
    //];
    //data penyakit
    $peny = [];
    foreach ($penyakit as $p) {
        $peny[$p->id_penyakit] = $p->kode_penyakit;
    }
    //data gejala
    $gejalaMap = [];
    foreach ($gej as $gg) {
        $gejalaMap[$gg->id_gejala] = $gg->kode_gejala;
    }
    // Susun array diseases
    $diseases = [];
    foreach ($relasi as $r) {
        // Ambil kode penyakit dan kode gejala
        $kodePenyakit = $peny[$r->id_penyakit];
        $kodeGejala = $gejalaMap[$r->id_gejala];

        // Tambahkan gejala ke penyakit
        if (!isset($diseases[$kodePenyakit])) {
            $diseases[$kodePenyakit] = [];
        }
        $diseases[$kodePenyakit][] = $kodeGejala;
    }


    // Define symptom weights
    $symptomWeights = [];
    foreach ($gej as $g) {
        $symptomWeights[$g->kode_gejala] = $g->belief;
    }
    if (isset($_POST["gejala"]) && is_array($_POST["gejala"])) {
    // User input symptoms
    $userSymptoms = $_POST["gejala"];

    // Initialize and diagnose
    $dsDiagnosis = new DempsterShaferDiagnosis($diseases, $symptomWeights);
    $result = $dsDiagnosis->diagnose($userSymptoms);

    // 1. Urutkan hasil berdasarkan nilai tertinggi
    arsort($result);

    // 2. Ambil 2 kunci teratas
    $topKeys = array_slice(array_keys($result), 0, 2);

    // 3. Ambil data penyakit sesuai dengan 2 kunci teratas
    $topPenyakit = array_filter($penyakit, function ($p) use ($topKeys) {
        return in_array($p->kode_penyakit, $topKeys);
    });

    // 4. Tampilkan hasil dalam bentuk tabel
    echo '
    <h2 class="ser-title">Hasil Diagnosa</h2>
    <hr class="botm-line">
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Kode Penyakit</th>
            <th>Nama Penyakit</th>
            <th>Deskripsi</th>
            <th>Solusi</th>
            <th>Presentase (%)</th>
        </tr>';
    foreach ($topPenyakit as $p) {
        $kode = $p->kode_penyakit;
        $presentase = isset($result[$kode]) ? round($result[$kode] * 100, 2) : 0; // Hitung presentase
        echo '
        <tr>
            <td>' . htmlspecialchars($p->kode_penyakit) . '</td>
            <td>' . htmlspecialchars($p->nama_penyakit) . '</td>
            <td>' . htmlspecialchars($p->deskripsi) . '</td>
            <td>' . htmlspecialchars($p->solusi) . '</td>
            <td>' . htmlspecialchars($presentase) . '%</td>
        </tr>';
    }
    echo '</table>';
    } else {
        echo "<h2>Tidak ada gejala yang dipilih!</h2>";
    }
    ?>
    <hr class="botm-line">
    <a class="btn btn-success" href="/diagnosa.php">Kembali ke Diagnosa.</a>
</div>
</section>
<!--/ hasil-->
<?php include("partial/footer.php");?>