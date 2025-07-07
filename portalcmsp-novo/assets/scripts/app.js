import Drag from "./Drag";
import LeiaMaisNoticia from "./LeiaMaisNoticia";
import {jsPDF} from "jspdf";
import html2canvas from "html2canvas";
import $ from "jquery";
import axios from "axios";

export default class App {
    constructor() {
        document.addEventListener('DOMContentLoaded', function() {
            /*var links = document.querySelectorAll('a');

            for (var i = 0; i < links.length; i++) {
                links[i].addEventListener('click', function(event) {
                    var currentDomain = window.location.hostname;
                    var linkDomain = this.hostname;

                    if (currentDomain !== linkDomain) {
                        event.preventDefault();
                        alert('Você será redirecionado para ' + this.href);
                        window.location.href = this.href
                    }
                });
            }*/
        });


        jQuery(document).ready(function () {
            document.querySelector(".close-menu").addEventListener("click", function() {
                document.querySelector("nav.sandwich").focus();
            });


            $(".schema-faq-question").click(function () {
                $(this).next().slideToggle();
                $(this).toggleClass("act");
            })

            if (jQuery('.explore-conteudos .contentDrag').length > 0)
                new Drag('.explore-conteudos .contentDrag');

            if (jQuery('.programas .contentDrag').length > 0)
                new Drag('.programas .contentDrag', 258);

            if (jQuery('.lista-noticias .contentDrag').length > 0)
                new Drag('.lista-noticias .contentDrag', 0, 0, true);

            jQuery('.sandwich, .close-menu').click(function () {
                jQuery('.menu-lateral').toggleClass('act');
                jQuery('.menu-lateral .overlay').fadeToggle();
                return false;
            });

            jQuery(".mensagem-contato nav > a").click(function () {
                jQuery(".mensagem-contato nav > a").removeClass('active').addClass('desktop-body-3');
                jQuery(this).addClass('active').removeClass('desktop-body-3');
                jQuery(".context", jQuery(this).parent().parent()).hide();
                jQuery("." + jQuery(this).attr("toggle-class"), jQuery(this).parent().parent()).show();

                return false;
            });

            jQuery('.menu-lateral .overlay').click(function () {
                jQuery('.menu-lateral').removeClass('act');
                jQuery('.menu-lateral .overlay').fadeOut();
                return false;
            });

            jQuery('.menu-wp ul li.menu-item-has-children > a').click(function () {
                jQuery(this).parent().toggleClass('act');
                jQuery('.sub-menu', jQuery(this).parent()).slideToggle();
                return false;
            });

            if (jQuery('.content-post').length > 0) {
                new LeiaMaisNoticia();
            }

            if (jQuery('.comentarios').length > 0) {
                jQuery('.comentarios').css('height', jQuery('body').innerHeight());
                jQuery('.ver-comentarios, .comentarios .close, .ver-comentarios-2').click(function () {
                    jQuery(".comentarios").toggleClass('act');
                    jQuery(".commentOverlay .overlay").fadeToggle();
                    jQuery('html, body').toggleClass('overflow-hidden');
                });

                var classeIgnorar = '.comentarios, .ver-comentarios';

                // Capturar o clique no <body>
                setTimeout(() => {
                    jQuery('.commentOverlay .overlay').click(function (event) {
                    // Verificar se o elemento clicado ou algum de seus ancestrais possui a classe a ser ignorada
                    if (!jQuery(event.target).closest(classeIgnorar).length) {
                        // Código a ser executado quando o clique no <body> ocorrer, excluindo a classe ignorada
                        if (jQuery(".comentarios").hasClass('act')) {
                            jQuery(".comentarios").toggleClass('act');
                            jQuery(".commentOverlay .overlay").fadeOut();
                            jQuery('html, body').removeClass('overflow-hidden');
                        }
                    }
                });
                }, 300);

                if (window.location.hash.includes('#comment-')) {
                    jQuery(".comentarios").toggleClass('act');
                    jQuery(".commentOverlay .overlay").fadeToggle();
                    jQuery('html, body').toggleClass('overflow-hidden');
                    jQuery('html, body').animate({
                        scrollTop: jQuery(window.location.hash).offsetTop
                    }, 800);
                }
            }


            jQuery('a').click(function () {
                if (jQuery(this).attr('href').includes("#comments")) {
                    jQuery(".comentarios").toggleClass('act');
                    jQuery(".commentOverlay .overlay").fadeToggle();
                    jQuery('html, body').toggleClass('overflow-hidden');
                    return false;
                }
            })


            jQuery('.consulta-rapida nav a').click(function () {
                jQuery('.consulta-rapida nav a').removeClass('active');
                jQuery(this).addClass('active');
                jQuery('.consulta-rapida .context').hide();
                jQuery('.consulta-rapida .context.' + jQuery(this).attr('data-active')).show();
                return false;
            });


            jQuery('.ultimos-videos nav a').click(function () {
                jQuery('.ultimos-videos nav a').removeClass('active');
                jQuery(this).addClass('active');
                jQuery('.ultimos-videos .context').hide();
                jQuery('.ultimos-videos .context.' + jQuery(this).attr('data-active')).show();
                return false;
            });

            jQuery('.skip-links').click(function () {
                jQuery("body").addClass("acessiblidade");
            })

            jQuery('[name="modo-exibicao"]').click(function () {
                if (jQuery(this).val() === "normal") {
                    jQuery(".flex-eventos").removeClass("flex-list")
                } else {
                    jQuery(".flex-eventos").addClass("flex-list")
                }
            });


            jQuery('[name="modo-exibicao"]').click(function () {
                if (jQuery(this).val() === "normal") {
                    jQuery(".flex-eventos").removeClass("flex-list")
                } else {
                    jQuery(".flex-eventos").addClass("flex-list")
                }
            });

            jQuery(".btn-pdf").click(() => {
                App.createPDF();
                return false;
            });

            var $elementAce = $('.acessibilidade-box');

// Close the element when clicking outside of it
            $(document).on('click', function(e) {
                if (!$elementAce.is(e.target) && $elementAce.has(e.target).length === 0 && !$('.acessibilidade').is(e.target) && $('.acessibilidade').has(e.target).length === 0) {
                    $elementAce.removeClass('act');
                    $('.acessibilidade').fadeIn();
                }
            });

// Toggle the class and fade effect on click
            $('.acessibilidade').click(function(e) {
                e.stopPropagation();
                $elementAce.addClass('act');
                $('.acessibilidade').fadeOut();
                return false;
            });

            $(".acessibilidade-box .button-secondary").click(function () {
                $elementAce.removeClass('act');
                $('.acessibilidade').fadeIn();
                return false;
            })


            // Get the body element
            // Get the html element
            var html = document.querySelector('html');

// Set the initial font size
            var fontSize = 62.5;
            var percent  = "100%";


            if($("html").attr("style")) {
                fontSize = parseFloat($("html").attr("style").replace("font-size: ", "").replace("%;", ""));
            }

// Increase font size on click
            document.getElementById('mais_fonte').addEventListener('click', function() {
                if (fontSize < 93.0) {
                    fontSize += 5;
                    html.style.fontSize = fontSize + '%';

                    percent = (fontSize / 62.5) * 100;
                    $(".tamanho-fonte span").html(Math.floor(percent) + "%");

                    axios.post("/novo/wp-json/custom/v1/acessibilidade", {
                        font :fontSize + '%',
                        percent :percent + '%',
                        contrast : $("#hight-contrast").is(":checked")
                    });
                }
            });

// Decrease font size on click
            document.getElementById('menos_fonte').addEventListener('click', function() {
                if (fontSize > 62.5) {
                    fontSize -= 5;
                    html.style.fontSize = fontSize + '%';

                    percent = (fontSize / 62.5) * 100;

                    $(".tamanho-fonte span").html(Math.round(percent) + "%");

                    axios.post("/novo/wp-json/custom/v1/acessibilidade", {
                        font :fontSize + '%',
                        percent :percent + '%',
                        contrast : $("#hight-contrast").is(":checked")
                    });
                }
            });

            $("#hight-contrast").change(function () {
                if($("#hight-contrast").is(":checked")) {
                    $("body").addClass("highcontrast");
                } else {
                    $("body").removeClass("highcontrast")
                }

                axios.post("/novo/wp-json/custom/v1/acessibilidade", {
                    font :fontSize + '%',
                    percent :percent + '%',
                    contrast : $("#hight-contrast").is(":checked")
                });
            });







            jQuery(".header-accordion").click(function () {
                jQuery(this).toggleClass("act");
                jQuery(this).next().slideToggle();
            });


            jQuery(".expandir-todos").click(function () {
                if(!jQuery(".expandir-todos").hasClass("act")) {
                    jQuery(".expandir-todos").addClass("act");
                    jQuery(".header-accordion").addClass("act");
                    jQuery(".header-accordion").next().slideDown();
                    jQuery(this).html("Recolher todos os itens").removeClass("button-primary").addClass("button-secondary");
                } else {
                    jQuery(".expandir-todos").removeClass("act");
                    jQuery(".header-accordion").removeClass("act");
                    jQuery(".header-accordion").next().slideUp();
                    jQuery(this).html("Expandir todos os itens").addClass("button-primary").removeClass("button-secondary");
                }
                return false;
            })
        });

    }
    static async createPDF() {
        var form = jQuery('.flex-eventos'),
            cache_width = form.width();
        jQuery('[name="modo-exibicao"]:last-child').click();
        App.getCanvas(form[0], "eventos.pdf"); // Esperar pela captura do canvas

        return false;
    }

    static getCanvas = async (html_source, filename) => {
        html2canvas(html_source).then(function(canvas) {
            /*
            [210,297] Sao os números (largura e altura do papel a4) que eu encontrei para trabalhar com eles.
            Se você puder encontrar números oficiais do jsPDF, usa.
             */
            let imgData = canvas.toDataURL('image/png');
            let imgWidth = 208; // Largura em mm de um a4
            let pageHeight = 297; // Altura em mm de um a4

            let imgHeight = canvas.height * imgWidth / canvas.width;
            let heightLeft = imgHeight;
            let position = 2;
            let pdf = new jsPDF('p', 'mm');
            let fix_imgWidth = 15; // Vai subindo e descendo esses valores ate ficar como queres
            let fix_imgHeight = 15; // Vai subindo e descendo esses valores ate ficar como queres

            pdf.addImage(imgData, 'PNG', 2, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                pdf.addPage();
                pdf.addImage(imgData, 'PNG', 2, position, imgWidth + fix_imgWidth, imgHeight + fix_imgHeight);
                heightLeft -= pageHeight;
            }

            pdf.save(filename);
            jQuery('[name="modo-exibicao"]:first-child').click();
        })
    }



}

new App();
