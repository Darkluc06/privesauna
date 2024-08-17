<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Luxe privé sauna boeken in Nederland &amp; België? Exclusief genieten in één van de prive sauna's in Nederland &amp; België ✓ Met overnachtingsmogelijkheid ✓ Grootste aanbod van Nederland &amp; België ✓ Laagste prijsgarantie" name="description" property="schema:description">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://kit.fontawesome.com/f21cc9e720.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/js/main.js" defer></script>
    <link rel="shortcut icon" href="https://privesauna.nl/favicon.ico">
    <title>PriveSauna</title>
</head>
<body>
    <header class="header">
        <section class="header__top">
            <section class="header__left">
                    <figure class="header__logo">
                        <a href="/">
                            <img src="public/images/logo.svg" alt="Privesauna logo"/>
                            <p class="header__title">privesauna.nl</p>
                        </a>
                    </figure>

                <form class="header__form" method="get">
                    <svg width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <circle cx="10" cy="10" r="7"></circle>
                        <path d="m21 21-6-6"></path>
                    </svg>
                    <input placeholder="In de buurt van..." type="text" id="search-bar" name="search">
                </form>
            </section>
            <ul class="header__right">
                <li class="header__link">
                    <a href="/">Zoek & Boek</a>
                </li>
                <li class="header__link">
                    <a href="/">Klantenservice</a>
                </li>
                <li class="header__link">
                    <a href="/">Wellness-cheque</a>
                </li>
            </ul>
        </section>
    </header>

    <section class="booking">



        <?php
        function normalTime($input){
            $interval = new DateInterval($input);
            $hours = $interval->h;
            $minutes = $interval->i;
            $decimalHours = $hours + ($minutes / 60);

            return str_replace('.', ',', (string)$decimalHours);
        }
        $json = file_get_contents("./system/data/data.json");
        $saunas = json_decode($json);
        foreach ($saunas as $sauna){
            ?>
            <article class="sauna">
                <figure class="sauna__figure">
                    <img class="js--sauna__placeholder" src="<?=$sauna->placeholder?>" alt="Photo van <?=$sauna->name?>">
                    <div class="sauna__images" id="<?=$sauna->id?>">

                    </div>
                    <button class="prev" onclick="plusSlides(-1, <?=$sauna->id?>)">&#10094;</button>
                    <button class="next" onclick="plusSlides(1, <?=$sauna->id?>)">&#10095;</button>
                    <span class="sauna__figure--city">
                        <svg width="1em" height="1em" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <circle cx="12" cy="11" r="3"></circle>
                            <path d="M17.657 16.657 13.414 20.9a2 2 0 0 1-2.827 0l-4.244-4.243a8 8 0 1 1 11.314 0z"></path>
                        </svg>
                        <?=$sauna->city?>
                    </span>
                </figure>
                <section class="sauna__data">
                    <h3 class="sauna__data--title"><?=$sauna->name?></h3>
                    <p class="sauna__data--options"><?=$sauna->options?></p>
                </section>
                <div class="sauna__info">
                    <p class="sauna__info--price"><?=normalTime($sauna->hours)?> uur v.a € <?=$sauna->price?></p>
                    <p class="sauna__info--rating">
                        <?=round($sauna->score, 1, PHP_ROUND_HALF_UP)?>
                        <span style="color:#eeba40;">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <?php
                                if (round($sauna->score, 1, PHP_ROUND_HALF_UP) >= 9.5){
                                    ?>
                                    <i class="fa-solid fa-star"></i>
                                    <?php
                                } else{
                                    ?>
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                    <?php
                                }
                            ?>
                        </span>
                        (<?=$sauna->reviews?>)
                    </p>
                </div>
            </article>
            <?php
        }
        ?>
    </section>
    <footer class="footer">
        <figure class="footer__logo">
            <img src="public/images/logo.svg" alt="Privesauna logo"/>
            <p class="footer__title">privesauna.nl</p>
        </figure>
    </footer>

</body>
</html>
