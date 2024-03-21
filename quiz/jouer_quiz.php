<?php
include ('../accueil/header.php');
$quizSelectionne = $_GET['quiz'];

$quizDataFile = fopen("../traitement/quiz_data.csv", "r");

if ($quizDataFile) {
    fgetcsv($quizDataFile);

    while (($quizData = fgetcsv($quizDataFile)) !== false) {
        if (!empty ($quizData[1]) && $quizSelectionne == $quizData[1]) {
            $titreQuiz = $quizData[1];

            echo "<h2>Titre du quiz : $titreQuiz</h2>";
            $questionsFile = fopen("../traitement/quiz_question.csv", "r");

            if ($questionsFile) {
                fgetcsv($questionsFile);
                $i = 0;
                while (($questionsData = fgetcsv($questionsFile)) !== false) {
                    if ($questionsData[0] === $titreQuiz) {
                        echo "<p>Question : {$questionsData[1]}</p>";
                        $reponsesFile = fopen("../traitement/quiz_reponse.csv", "r");

                        if ($reponsesFile) {
                            fgetcsv($reponsesFile);

                            $reponseSelectionnee = false;

                            while (($reponsesData = fgetcsv($reponsesFile)) !== false) {
                                if ($reponsesData[0] === $titreQuiz && $reponsesData[1] === $questionsData[1]) {
                                    $i += 1;
                                    echo "<form action='' method='post'>";
                                    echo "<input type='radio' name='question" . $i . "' value='{$reponsesData[2]}'> {$reponsesData[2]}<br>";
                                    echo "<input type='radio' name='question" . $i . "' value='{$reponsesData[3]}'> {$reponsesData[3]}<br>";
                                    echo "<input type='radio' name='question" . $i . "' value='{$reponsesData[4]}'> {$reponsesData[4]}<br>";
                                    echo "<input type='radio' name='question" . $i . "' value='{$reponsesData[5]}'> {$reponsesData[5]}<br>";

                                    $reponseSelectionnee = true;
                                }
                            }
                            fclose($reponsesFile);

                            if (!$reponseSelectionnee) {
                                echo "<p style='color: red;'>Vous devez sélectionner une réponse pour cette question.</p>";
                            }
                        }
                    }
                }
                fclose($questionsFile);
                echo "<input type='submit' value='Valider'>";
                echo "</form>";

                $score = 0;
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $reponsesFile = fopen("../traitement/quiz_reponse.csv", "r");
                    $questionsFile = fopen("../traitement/quiz_question.csv", "r");

                    if ($questionsFile) {
                        fgetcsv($questionsFile);
                        while (($questionsData = fgetcsv($questionsFile)) !== false) {

                            if ($reponsesFile) {
                                fgetcsv($reponsesFile);

                                while (($reponsesData = fgetcsv($reponsesFile)) !== false) {
                                    if (isset ($_POST['question1'])) {
                                        $reponseUtilisateur = $_POST['question1'];
                                        if ($reponseUtilisateur == $reponsesData[6]) {
                                            $score++;
                                        }
                                    }
                                    if (isset ($_POST['question2'])) {
                                        $reponseUtilisateur = $_POST['question2'];
                                        if ($reponseUtilisateur == $reponsesData[6]) {
                                            $score++;
                                        }
                                    }
                                    if (isset ($_POST['question3'])) {
                                        $reponseUtilisateur = $_POST['question3'];
                                        if ($reponseUtilisateur == $reponsesData[6]) {
                                            $score++;
                                        }
                                    }
                                    if (isset ($_POST['question4'])) {
                                        $reponseUtilisateur = $_POST['question4'];
                                        if ($reponseUtilisateur == $reponsesData[6]) {
                                            $score++;
                                        }
                                    }

                                }
                                fclose($reponsesFile);
                            }
                            $resultatFile = fopen("../traitement/quiz_resultat.csv", "a");
                            if ($line[1] == $_SESSION['id'] && $line[2] == $questionsData[0]) {
                                echo "EHHHH non tu l'as déja fait mon grand";
                            } else {
                                fputcsv($resultatFile, [$_SESSION['rôle'], $_SESSION['id'], $questionsData[0], $score]);
                                fclose($resultatFile);
                                header('location: ../quiz/score.php');
                            }
                        }fclose($questionsFile);
                    }
                }
                
            }
        }
    }
    fclose($quizDataFile);


}
