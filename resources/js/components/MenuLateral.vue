<template>
    <div>
        <div class="aside-principal">
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
            text-align: center;
            font-size: 18px;
            text-decoration: underline;
            padding: 0.25em;
        }
        ul {
            margin: 0;
            padding: 0;
        }
        li {
            list-style: none;
            margin-left: 5em;
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
