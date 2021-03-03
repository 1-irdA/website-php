<?php

use App\Utils;

$title = 'Mon profil';

?>
<div class="text-center">
    <p class="font-weight-bold">Adrien GARROUSTE - <?= Utils::getMyAge() ?> ans</p>
    <p>Etudiant en informatique <i class="fas fa-laptop-code"></i></p>
</div>
<div class="row">
    <div class="card col-md-6">
        <div class="card-body">
            Passionné par le développement :
            <ul>
                <li>Logiciel&nbsp;&nbsp;<i class="fas fa-keyboard"></i></li>
                <li>Système&nbsp;&nbsp;<i class="fab fa-windows"></i> <i class="fab fa-ubuntu"></i></li>
                <li>Web&nbsp;&nbsp;<i class="fas fa-at"></i></li>
                <li>Mobile&nbsp;&nbsp;<i class="fas fa-mobile-alt"></i></li>
            </ul>
            Également passionné par :
            <ul>
                <li>Course à pied&nbsp;&nbsp;<i class="fas fa-running"></i></li>
                <li>Musculation&nbsp;&nbsp;<i class="fas fa-dumbbell"></i></li>
                <li>Taekwondo (ceinture rouge 2 barres)
                    <ul>
                        <li>Décembre 2019 : 3 ème place au championnat de taekwondo d'Occitanie </li>
                        <li>Janvier 2020 : Participation au championnat de France de taekwondo</li>
                    </ul>
                </li>
                <li>Musique&nbsp;&nbsp;<i class="fab fa-spotify"></i></li>
            </ul>

        </div>
    </div>
    <div class="card col-md-6">
        <div class="card-body">
            <i class="far fa-id-card"></i>&nbsp;&nbsp;<a href="../resources/CV/CV.pdf">CV</a>
            <p class="font-weight-bold mt-4">Me contacter</p>
            <i class="fas fa-envelope-open fa-1x"></i>&nbsp;&nbsp;<a href="mailto:garrousteadrien@gmail.com" title="Mon adresse mail">garrousteadrien@gmail.com</a><br/>
            <i class="fab fa-linkedin fa-1x"></i>&nbsp;&nbsp;<a href="https://www.linkedin.com/in/adrien-garrouste-7b747117b" title="LinkedIn" target="blank">LinkedIn</a><br/>
            <i class="fab fa-facebook-square fa-1x"></i>&nbsp;&nbsp;<a href="https://www.facebook.com/adrien.garrouste" title="Facebook" target="blank">Facebook</a><br/>
            <i class="fab fa-instagram"></i>&nbsp;&nbsp;<a href="https://www.instagram.com/adriengarrouste" title="Instagram" target="blank">Instagram</a><br/>
            <i class="fab fa-github fa-1x"></i>&nbsp;&nbsp;<a href="https://github.com/1irdA" title="GitHub" target="blank">GitHub</a><br/>
        </div>
    </div>
</div>