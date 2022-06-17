<template>
    <div>
        <div id="menuNotCollapse" class="aside-principal">
            <div class="aside-seccion">
                <p class="subtitulo">Descubre</p>
                <ul>
                    <li>
                        <button class="categoria" onclick="aleatorio()">
                            <box-icon name="shuffle"></box-icon>
                            &nbsp;&nbsp;Aleatorio
                        </button>
                    </li>
                </ul>
            </div>
            <div class="aside-seccion">
                <p class="subtitulo">Colores</p>
                <ul>
                    <li><a href="/?query=blanco" class="categoria"><p class="color white"></p>Blanco</a></li>
                    <li><a href="/?query=negro" class="categoria"><p class="color black"></p>Negro</a></li>
                    <li><a href="/?query=rojo" class="categoria"><p class="color red"></p>Rojo</a></li>
                    <li><a href="/?query=naranja" class="categoria"><p class="color orange"></p>Naranja</a></li>
                    <li><a href="/?query=verde" class="categoria"><p class="color green"></p> Verde</a> </li>
                    <li><a href="/?query=morado" class="categoria"><p class="color purple"></p> Morado</a></li>
                    <li><a href="/?query=azul" class="categoria"><p class="color blue"></p>Azul</a></li>
                    <li><a href="/?query=amarillo" class="categoria"><p class="color yellow"></p>Amarillo</a></li>
                </ul>
            </div>
            <div class="aside-seccion">
                <p class="subtitulo">Tags</p>
                <ul>
                    <li><a href="/?query=animales" class="categoria"><i class="bx bxs-cat icon"></i>Animales</a></li>
                    <li><a href="/?query=vehiculos" class="categoria"><i class="bx bxs-car icon"></i>Vehiculos</a></li>
                    <li><a href="/?query=juegos" class="categoria"><i class="bx bxs-joystick icon"></i>Juegos</a></li>
                    <li><a href="/?query=naturaleza" class="categoria"><i class="bx bxs-florist icon"></i>Naturaleza</a> </li>
                    <li><a href="/?query=peliculas" class="categoria"><i class="bx bxs-camera-movie icon"></i>Peliculas</a></li>
                    <li><a href="/?query=ciudad" class="categoria"><i class="bx bxs-business icon"></i> Ciudad</a> </li>
                </ul>
            </div>
        </div>
        <div class="d-flex justify-content-center w-100">
            <button id="menuCollapse" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon">Menu Lateral</span>
            <!-- Authentication Links -->
                <div class="aside-principal">
                    <ul id="drop-down">
                        <ul id="content">
                            <div class="aside-seccion">
                                <p class="subtitulo">Descubre</p>
                                <ul>
                                    <li>
                                        <button class="categoria" onclick="aleatorio()">
                                            <box-icon name="shuffle"></box-icon>
                                            &nbsp;&nbsp;Aleatorio
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="aside-seccion">
                                <p class="subtitulo">Colores</p>
                                <ul>
                                    <li><a href="/?query=blanco" class="categoria"><p class="color white"></p>Blanco</a></li>
                                    <li><a href="/?query=negro" class="categoria"><p class="color black"></p>Negro</a></li>
                                    <li><a href="/?query=rojo" class="categoria"><p class="color red"></p>Rojo</a></li>
                                    <li><a href="/?query=naranja" class="categoria"><p class="color orange"></p>Naranja</a></li>
                                    <li><a href="/?query=verde" class="categoria"><p class="color green"></p> Verde</a> </li>
                                    <li><a href="/?query=morado" class="categoria"><p class="color purple"></p> Morado</a></li>
                                    <li><a href="/?query=azul" class="categoria"><p class="color blue"></p>Azul</a></li>
                                    <li><a href="/?query=amarillo" class="categoria"><p class="color yellow"></p>Amarillo</a></li>
                                </ul>
                            </div>
                            <div class="aside-seccion">
                                <p class="subtitulo">Tags</p>
                                <ul>
                                    <li><a href="/?query=animales" class="categoria"><i class="bx bxs-cat icon"></i>Animales</a></li>
                                    <li><a href="/?query=vehiculos" class="categoria"><i class="bx bxs-car icon"></i>Vehiculos</a></li>
                                    <li><a href="/?query=juegos" class="categoria"><i class="bx bxs-joystick icon"></i>Juegos</a></li>
                                    <li><a href="/?query=naturaleza" class="categoria"><i class="bx bxs-florist icon"></i>Naturaleza</a> </li>
                                    <li><a href="/?query=peliculas" class="categoria"><i class="bx bxs-camera-movie icon"></i>Peliculas</a></li>
                                    <li><a href="/?query=ciudad" class="categoria"><i class="bx bxs-business icon"></i> Ciudad</a> </li>
                                </ul>
                            </div>
                        </ul>
                    </ul>
                </div>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {};
    },
    mounted() {},
};
</script>
<style lang="scss" scoped>


.navbar-toggler-icon{
    display: flex;
    justify-self: center;
    width: 100%;
}
#drop-down {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    text-align: left;
}

#content {
    background-color: rgb(243, 231, 231);
    border: 1px solid rgb(148, 148, 148); 
    border-radius: 2px;
    display: none;
    flex-direction: column;
    position: absolute;
    z-index: 1;
    width: 100%;
}

#content>li {
    padding-top: 3em;
    padding: 1em;
    display: flex;
    list-style: none;
    text-decoration: none;
    flex-direction: row-reverse;
    font-size: 14px;
}

#content>.nav-item>a {
    padding: 0em;
    text-decoration: none;
}

#title-profile {
    font-weight: bold;
    text-decoration: none;
    text-align: right;
    color: black;
}

#menuCollapse:focus #content,
#content:focus,
#title-profile:focus+#content {
    display: flex;
}

@media (max-width: 768px) {
    #menuNotCollapse {
        display: none;
    }
}
@media (min-width: 768px) {
    #menuCollapse {
        display: none;
    }
}
.aside-principal {
    font-size: 20px;
    font-weight: 100;
    padding-bottom: 1em;

    @media (min-width: 768px) {
        .aside-principal {
            width: 75%;
        }
    }
    .aside-seccion {
        height: fit-content;
        width: 100vw;

        .subtitulo {
            font-size: 18px;
            margin-left: -2em ;
            padding: 0.5em;
            text-align: center;
            text-decoration: underline;
        }
        ul {
            margin: 0;
            padding: 0;
        }
        li {
            list-style: none;
            button {
                margin: 0px;
            }
            .categoria {
                display: flex;
                background: none;
                border: 0;
                color: inherit;
                font-size: 15px;
                margin: 1em;
                margin-left: 3em;
                text-decoration: none;
                .icon {
                    font-size: 20px;
                    margin-right: 1em;
                }
            }
            .color {
                text-align: center;
                border: 1px solid black;
                margin-right: 1em;
                margin-top: 0.2em;
                width: 15px;
                height: 15px;
            }
        }
    }
    @media (min-width: 768px) {
        .aside-seccion {
            width: 75%;
            li {
                margin-left: 0;
                .categoria {
                    padding-left: 4em;
                    margin-left: 0;

                }
            }
        }
    }
}
</style>
