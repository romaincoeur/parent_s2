/**
 * Created by romain on 16/04/14.
 */


$(function() {


//    $('table.availability').data('constraints', {});

// Affix menu
    function setMenuPosition(){
        var bottom_ofset = $('div.profiles').offset().top + $('div.profiles').height() - $('aside').height();
        //console.log($('div.profiles').height());
        if ($(window).scrollTop() < $('div.profiles').offset().top || $('div.profiles').height() < $('aside').height()) {
            console.log('top');
            $('aside').removeClass("affix").removeClass("affix-bottom").addClass("affix-top");
            $('div.profiles').css('margin-left','0');
        }
        else if($(window).scrollTop() > bottom_ofset){
            console.log('bottom');
            $('aside').removeClass("affix").removeClass('affix-top').addClass("affix-bottom");
            $('div.profiles').css('margin-left','335px');
        }
        else if( $(window).scrollTop() > $('div.profiles').offset().top) {
            console.log('fixed');
            $('aside').removeClass("affix-bottom").removeClass('affix-top').addClass("affix").data("top", top);
            $('div.profiles').css('margin-left','335px');
        }
    }
    setMenuPosition();
    $(window).scroll(function() {
        setMenuPosition();
    });


    //Give onclick functionality to the cells in the calendar
    $('table.availability td.checkbox').click(function(e){
        e.preventDefault();

        //See if the cell is already checked
        var $checkbox = $(this).find('input[type=checkbox]');
        var $is_checked = $checkbox.attr('checked');
        if ($is_checked) // uncheck it if so
        {
            $checkbox.attr('checked', false);
            $(this).removeClass('checked');
            $('table.availability').removeData($checkbox.attr('name'));
        }
        else // check it if not
        {
            $checkbox.attr('checked', true);
            $(this).addClass('checked');
            $('table.availability').data($checkbox.attr('name'), true);
        }

        update();
    });

    $('input').change(function () {
        update();
    });


    function update(){
        $('div.profile').css('display', function(){

            // Calendrier - lundi - tot le matin (5h - 9h)
            if ($('table.availability input[name="availability[1][0]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(38) === '0' &&
                    $(this).data('calendar').charAt(47) === '0' &&
                    $(this).data('calendar').charAt(56) === '0' &&
                    $(this).data('calendar').charAt(65) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - mardi - tot le matin (5h - 9h)
            if ($('table.availability input[name="availability[1][1]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(39) === '0' &&
                    $(this).data('calendar').charAt(48) === '0' &&
                    $(this).data('calendar').charAt(57) === '0' &&
                    $(this).data('calendar').charAt(66) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - mercredi - tot le matin (5h - 9h)
            if ($('table.availability input[name="availability[1][2]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(40) === '0' &&
                    $(this).data('calendar').charAt(49) === '0' &&
                    $(this).data('calendar').charAt(58) === '0' &&
                    $(this).data('calendar').charAt(67) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - jeudi - tot le matin (5h - 9h)
            if ($('table.availability input[name="availability[1][3]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(41) === '0' &&
                    $(this).data('calendar').charAt(50) === '0' &&
                    $(this).data('calendar').charAt(59) === '0' &&
                    $(this).data('calendar').charAt(68) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - vendredi - tot le matin (5h - 9h)
            if ($('table.availability input[name="availability[1][4]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(42) === '0' &&
                    $(this).data('calendar').charAt(51) === '0' &&
                    $(this).data('calendar').charAt(60) === '0' &&
                    $(this).data('calendar').charAt(69) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - samedi - tot le matin (5h - 9h)
            if ($('table.availability input[name="availability[1][5]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(43) === '0' &&
                    $(this).data('calendar').charAt(52) === '0' &&
                    $(this).data('calendar').charAt(61) === '0' &&
                    $(this).data('calendar').charAt(70) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - dimanche - tot le matin (5h - 9h)
            if ($('table.availability input[name="availability[1][6]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(44) === '0' &&
                    $(this).data('calendar').charAt(53) === '0' &&
                    $(this).data('calendar').charAt(62) === '0' &&
                    $(this).data('calendar').charAt(71) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - lundi - matin (9h - 13h)
            if ($('table.availability input[name="availability[2][0]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(74) === '0' &&
                    $(this).data('calendar').charAt(83) === '0' &&
                    $(this).data('calendar').charAt(92) === '0' &&
                    $(this).data('calendar').charAt(101) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - mardi - matin (9h - 13h)
            if ($('table.availability input[name="availability[2][1]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(75) === '0' &&
                    $(this).data('calendar').charAt(84) === '0' &&
                    $(this).data('calendar').charAt(93) === '0' &&
                    $(this).data('calendar').charAt(102) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - mercredi - matin (9h - 13h)
            if ($('table.availability input[name="availability[2][2]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(76) === '0' &&
                    $(this).data('calendar').charAt(85) === '0' &&
                    $(this).data('calendar').charAt(94) === '0' &&
                    $(this).data('calendar').charAt(103) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - jeudi - matin (9h - 13h)
            if ($('table.availability input[name="availability[2][3]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(77) === '0' &&
                    $(this).data('calendar').charAt(86) === '0' &&
                    $(this).data('calendar').charAt(95) === '0' &&
                    $(this).data('calendar').charAt(104) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - vendredi - matin (9h - 13h)
            if ($('table.availability input[name="availability[2][4]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(78) === '0' &&
                    $(this).data('calendar').charAt(87) === '0' &&
                    $(this).data('calendar').charAt(96) === '0' &&
                    $(this).data('calendar').charAt(105) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - samedi - matin (9h - 13h)
            if ($('table.availability input[name="availability[2][5]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(79) === '0' &&
                    $(this).data('calendar').charAt(88) === '0' &&
                    $(this).data('calendar').charAt(97) === '0' &&
                    $(this).data('calendar').charAt(106) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - dimanche - matin (9h - 13h)
            if ($('table.availability input[name="availability[2][6]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(80) === '0' &&
                    $(this).data('calendar').charAt(89) === '0' &&
                    $(this).data('calendar').charAt(98) === '0' &&
                    $(this).data('calendar').charAt(107) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - lundi - apresmidi (13h - 18h)
            if ($('table.availability input[name="availability[3][0]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(110) === '0' &&
                    $(this).data('calendar').charAt(119) === '0' &&
                    $(this).data('calendar').charAt(128) === '0' &&
                    $(this).data('calendar').charAt(137) === '0' &&
                    $(this).data('calendar').charAt(146) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - mardi - apresmidi (13h - 18h)
            if ($('table.availability input[name="availability[3][1]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(111) === '0' &&
                    $(this).data('calendar').charAt(120) === '0' &&
                    $(this).data('calendar').charAt(129) === '0' &&
                    $(this).data('calendar').charAt(138) === '0' &&
                    $(this).data('calendar').charAt(147) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - mercredi - apresmidi (13h - 18h)
            if ($('table.availability input[name="availability[3][2]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(112) === '0' &&
                    $(this).data('calendar').charAt(121) === '0' &&
                    $(this).data('calendar').charAt(130) === '0' &&
                    $(this).data('calendar').charAt(139) === '0' &&
                    $(this).data('calendar').charAt(148) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - jeudi - apresmidi (13h - 18h)
            if ($('table.availability input[name="availability[3][3]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(113) === '0' &&
                    $(this).data('calendar').charAt(122) === '0' &&
                    $(this).data('calendar').charAt(131) === '0' &&
                    $(this).data('calendar').charAt(140) === '0' &&
                    $(this).data('calendar').charAt(149) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - vendredi - apresmidi (13h - 18h)
            if ($('table.availability input[name="availability[3][4]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(114) === '0' &&
                    $(this).data('calendar').charAt(123) === '0' &&
                    $(this).data('calendar').charAt(132) === '0' &&
                    $(this).data('calendar').charAt(141) === '0' &&
                    $(this).data('calendar').charAt(150) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - samedi - apresmidi (13h - 18h)
            if ($('table.availability input[name="availability[3][5]"]').attr('checked') === 'checked')
            {

                if ($(this).data('calendar').charAt(115) === '0' &&
                    $(this).data('calendar').charAt(124) === '0' &&
                    $(this).data('calendar').charAt(133) === '0' &&
                    $(this).data('calendar').charAt(142) === '0' &&
                    $(this).data('calendar').charAt(151) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - dimanche - apresmidi (13h - 18h)
            if ($('table.availability input[name="availability[3][6]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(116) === '0' &&
                    $(this).data('calendar').charAt(125) === '0' &&
                    $(this).data('calendar').charAt(134) === '0' &&
                    $(this).data('calendar').charAt(143) === '0' &&
                    $(this).data('calendar').charAt(152) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - lundi - soir (18h - 22h)
            if ($('table.availability input[name="availability[4][0]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(155) === '0' &&
                    $(this).data('calendar').charAt(164) === '0' &&
                    $(this).data('calendar').charAt(173) === '0' &&
                    $(this).data('calendar').charAt(182) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - mardi - soir (18h - 22h)
            if ($('table.availability input[name="availability[4][1]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(156) === '0' &&
                    $(this).data('calendar').charAt(165) === '0' &&
                    $(this).data('calendar').charAt(174) === '0' &&
                    $(this).data('calendar').charAt(183) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - mercredi - soir (18h - 22h)
            if ($('table.availability input[name="availability[4][2]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(157) === '0' &&
                    $(this).data('calendar').charAt(166) === '0' &&
                    $(this).data('calendar').charAt(175) === '0' &&
                    $(this).data('calendar').charAt(184) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - jeudi - soir (18h - 22h)
            if ($('table.availability input[name="availability[4][3]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(158) === '0' &&
                    $(this).data('calendar').charAt(167) === '0' &&
                    $(this).data('calendar').charAt(176) === '0' &&
                    $(this).data('calendar').charAt(185) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - vendredi - soir (18h - 22h)
            if ($('table.availability input[name="availability[4][4]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(159) === '0' &&
                    $(this).data('calendar').charAt(168) === '0' &&
                    $(this).data('calendar').charAt(177) === '0' &&
                    $(this).data('calendar').charAt(186) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - samedi - soir (18h - 22h)
            if ($('table.availability input[name="availability[4][5]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(160) === '0' &&
                    $(this).data('calendar').charAt(169) === '0' &&
                    $(this).data('calendar').charAt(178) === '0' &&
                    $(this).data('calendar').charAt(187) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - dimanche - soir (18h - 22h)
            if ($('table.availability input[name="availability[4][6]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(161) === '0' &&
                    $(this).data('calendar').charAt(170) === '0' &&
                    $(this).data('calendar').charAt(179) === '0' &&
                    $(this).data('calendar').charAt(188) === '0'
                    ){ return 'none'; }
            }

            // Calendrier - lundi - nuit (22h - 5h le lendemain)
            if ($('table.availability input[name="availability[5][0]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(191)    === '0' &&
                    $(this).data('calendar').charAt(200)    === '0' &&
                    $(this).data('calendar').charAt(209)    === '0' &&
                    $(this).data('calendar').charAt(3)      === '0' &&
                    $(this).data('calendar').charAt(12)     === '0' &&
                    $(this).data('calendar').charAt(21)     === '0' &&
                    $(this).data('calendar').charAt(30)     === '0'
                    ){ return 'none'; }
            }

            // Calendrier - mardi - nuit (22h - 5h le lendemain)
            if ($('table.availability input[name="availability[5][1]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(192)    === '0' &&
                    $(this).data('calendar').charAt(201)    === '0' &&
                    $(this).data('calendar').charAt(210)    === '0' &&
                    $(this).data('calendar').charAt(4)      === '0' &&
                    $(this).data('calendar').charAt(13)     === '0' &&
                    $(this).data('calendar').charAt(22)     === '0' &&
                    $(this).data('calendar').charAt(31)     === '0'
                    ){ return 'none'; }
            }

            // Calendrier - mercredi - nuit (22h - 5h le lendemain)
            if ($('table.availability input[name="availability[5][2]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(193)    === '0' &&
                    $(this).data('calendar').charAt(202)    === '0' &&
                    $(this).data('calendar').charAt(211)    === '0' &&
                    $(this).data('calendar').charAt(5)      === '0' &&
                    $(this).data('calendar').charAt(14)     === '0' &&
                    $(this).data('calendar').charAt(23)     === '0' &&
                    $(this).data('calendar').charAt(32)     === '0'
                    ){ return 'none'; }
            }

            // Calendrier - jeudi - nuit (22h - 5h le lendemain)
            if ($('table.availability input[name="availability[5][3]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(194)    === '0' &&
                    $(this).data('calendar').charAt(203)    === '0' &&
                    $(this).data('calendar').charAt(212)    === '0' &&
                    $(this).data('calendar').charAt(6)      === '0' &&
                    $(this).data('calendar').charAt(15)     === '0' &&
                    $(this).data('calendar').charAt(24)     === '0' &&
                    $(this).data('calendar').charAt(33)     === '0'
                    ){ return 'none'; }
            }

            // Calendrier - vendredi - nuit (22h - 5h le lendemain)
            if ($('table.availability input[name="availability[5][4]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(195)    === '0' &&
                    $(this).data('calendar').charAt(204)    === '0' &&
                    $(this).data('calendar').charAt(213)    === '0' &&
                    $(this).data('calendar').charAt(7)      === '0' &&
                    $(this).data('calendar').charAt(16)     === '0' &&
                    $(this).data('calendar').charAt(25)     === '0' &&
                    $(this).data('calendar').charAt(34)     === '0'
                    ){ return 'none'; }
            }

            // Calendrier - samedi - nuit (22h - 5h le lendemain)
            if ($('table.availability input[name="availability[5][5]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(196)    === '0' &&
                    $(this).data('calendar').charAt(205)    === '0' &&
                    $(this).data('calendar').charAt(214)    === '0' &&
                    $(this).data('calendar').charAt(8)      === '0' &&
                    $(this).data('calendar').charAt(17)     === '0' &&
                    $(this).data('calendar').charAt(26)     === '0' &&
                    $(this).data('calendar').charAt(35)     === '0'
                    ){ return 'none'; }
            }

            // Calendrier - dimanche - nuit (22h - 5h le lendemain)
            if ($('table.availability input[name="availability[5][6]"]').attr('checked') === 'checked')
            {
                if ($(this).data('calendar').charAt(197)    === '0' &&
                    $(this).data('calendar').charAt(206)    === '0' &&
                    $(this).data('calendar').charAt(215)    === '0' &&
                    $(this).data('calendar').charAt(2)      === '0' &&
                    $(this).data('calendar').charAt(11)     === '0' &&
                    $(this).data('calendar').charAt(20)     === '0' &&
                    $(this).data('calendar').charAt(29)     === '0'
                    ){ return 'none'; }
            }

            // Babysitter type
            if (!$('input[name="category[babysitter]"]').is(':checked'))
            {

                if ($(this).data('category') === 'babysitter'){ return 'none'; }
            }

            // Assistante type
            if (!$('input[name="category[assistanteMaternelle]"]').is(':checked'))
            {

                if ($(this).data('category') === 'assistante'){ return 'none'; }
            }

            // Animatrice type
            if (!$('input[name="category[animatrice]"]').is(':checked'))
            {

                if ($(this).data('category') === 'animatrice'){ return 'none'; }
            }

            // nounou type
            if (!$('input[name="category[nounou]"]').is(':checked'))
            {

                if ($(this).data('category') === 'nounou'){ return 'none'; }
            }

            // aupair type
            if (!$('input[name="category[aupair]"]').is(':checked'))
            {

                if ($(this).data('category') === 'aupair'){ return 'none'; }
            }

            // Experience
            if ($('input[name="experience"]:checked').val() != 0)
            {

                if ( parseInt($(this).data('experience')) < $('input[name="experience"]:checked').val()){ return 'none'; }
            }

            // Age of children 0-1
            if ($('input[name="age[0-1]"]').is(':checked'))
            {
                if (parseInt($.inArray( "0", $(this).data('age'))) < 0 ){ return 'none'; }
            }

            // Age of children 1-3
            if ($('input[name="age[1-3]"]').is(':checked'))
            {
                if (parseInt($.inArray( "1", $(this).data('age'))) < 0 ){ return 'none'; }
            }

            // Age of children 3-6
            if ($('input[name="age[3-6]"]').is(':checked'))
            {
                if (parseInt($.inArray( "2", $(this).data('age'))) < 0 ){ return 'none'; }
            }

            // Age of children 6-10
            if ($('input[name="age[6-10]"]').is(':checked'))
            {
                if (parseInt($.inArray( "3", $(this).data('age'))) < 0 ){ return 'none'; }
            }

            // Age of children 10+
            if ($('input[name="age[10+]"]').is(':checked'))
            {
                if (parseInt($.inArray( "4", $(this).data('age'))) < 0 ){ return 'none'; }
            }

            // Language fr
            if ($('input[name="language[fr]"]').is(':checked'))
            {
                if (parseInt($.inArray( "fr", $(this).data('language'))) < 0 ){ return 'none'; }
            }

            // Language en
            if ($('input[name="language[en]"]').is(':checked'))
            {
                if (parseInt($.inArray( "en", $(this).data('language'))) < 0 ){ return 'none'; }
            }

            // Language it
            if ($('input[name="language[it]"]').is(':checked'))
            {
                if (parseInt($.inArray( "it", $(this).data('language'))) < 0 ){ return 'none'; }
            }

            // Language es
            if ($('input[name="language[es]"]').is(':checked'))
            {
                if (parseInt($.inArray( "es", $(this).data('language'))) < 0 ){ return 'none'; }
            }

            // Language ge
            if ($('input[name="language[ge]"]').is(':checked'))
            {
                if (parseInt($.inArray( "ge", $(this).data('language'))) < 0 ){ return 'none'; }
            }

            // Language ru
            if ($('input[name="language[ru]"]').is(':checked'))
            {
                if (parseInt($.inArray( "ru", $(this).data('language'))) < 0 ){ return 'none'; }
            }

            // Language other
            if ($('input[name="language[other]"]').is(':checked'))
            {
                if (parseInt($.inArray( "other", $(this).data('language'))) < 0 ){ return 'none'; }
            }

            // Particularite nonfumeur
            if ($('input[name="particularite[nonfumeur]"]').is(':checked'))
            {
                if (parseInt($.inArray( "nonfumeur", $(this).data('particularite'))) < 0 ){ return 'none'; }
            }

            // Particularite animaux
            if ($('input[name="particularite[animaux]"]').is(':checked'))
            {
                if (parseInt($.inArray( "animaux", $(this).data('particularite'))) < 0 ){ return 'none'; }
            }

            // Particularite permis
            if ($('input[name="particularite[permis]"]').is(':checked'))
            {
                if (parseInt($.inArray( "permis", $(this).data('particularite'))) < 0 ){ return 'none'; }
            }

            // Particularite voiture
            if ($('input[name="particularite[voiture]"]').is(':checked'))
            {
                if (parseInt($.inArray( "voiture", $(this).data('particularite'))) < 0 ){ return 'none'; }
            }

            // Particularite lettre
            if ($('input[name="particularite[lettre]"]').is(':checked'))
            {
                if (parseInt($.inArray( "lettre", $(this).data('particularite'))) < 0 ){ return 'none'; }
            }

            // Extra task cleaning
            if ($('input[name="extraTask[cleaning]"]').is(':checked'))
            {
                if (parseInt($.inArray( "cleaning", $(this).data('extratasks'))) < 0 ){ return 'none'; }
            }

            // Extra task cooking
            if ($('input[name="extraTask[cooking]"]').is(':checked'))
            {
                if (parseInt($.inArray( "cooking", $(this).data('extratasks'))) < 0 ){ return 'none'; }
            }

            // Extra task irioning
            if ($('input[name="extraTask[ironing]"]').is(':checked'))
            {
                if (parseInt($.inArray( "ironing", $(this).data('extratasks'))) < 0 ){ return 'none'; }
            }

            // Extra task homework
            if ($('input[name="extraTask[homework]"]').is(':checked'))
            {
                if (parseInt($.inArray( "homework", $(this).data('extratasks'))) < 0 ){ return 'none'; }
            }

            // Petits plus repasmaison
            if ($('input[name="petitplus[repasmaison]"]').is(':checked'))
            {
                if (parseInt($.inArray( "repasmaison", $(this).data('petitplus'))) < 0 ){ return 'none'; }
            }

            // Petits plus bio
            if ($('input[name="petitplus[bio]"]').is(':checked'))
            {
                if (parseInt($.inArray( "bio", $(this).data('petitplus'))) < 0 ){ return 'none'; }
            }

            // Petits plus promenade
            if ($('input[name="petitplus[promenade]"]').is(':checked'))
            {
                if (parseInt($.inArray( "promenade", $(this).data('petitplus'))) < 0 ){ return 'none'; }
            }

            // Petits plus notv
            if ($('input[name="petitplus[notv]"]').is(':checked'))
            {
                if (parseInt($.inArray( "notv", $(this).data('petitplus'))) < 0 ){ return 'none'; }
            }

            return 'block';
        })
    }


    /*function strToMat(str){
     String[] result = str.split("\\s");
     for (int x=0; x<result.length; x++)
     System.out.println(result[x]);

     }
     */





})