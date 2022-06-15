<template>
    <div class="imagen" v-if="!error">
        <div class="marca-de-agua">
            <img src="/img/Logotipo_PI_header.png" />
        </div>
        <!-- Se utiliza el src.large2x debido a que tiene buena calidad y carga rapido -->
        <img :src="photo.src.large2x" alt="Cargador universal phoenix" />
        <div class="opciones">
            <form action="/imagen" method="GET" class="w-100">
                <!-- Se hace stringify para poder pasar el objeto al php -->
                <input
                    type="hidden"
                    name="photo"
                    :value="JSON.stringify(photo)"
                />
                <input type="submit" value="Ver foto" class="verButton" />
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: ["photo"],

    data() {
        return {};
    },
};
</script>

<style lang="scss" scoped>
.marca-de-agua {
    background-image: url("/img/Logotipo PI header.png");
    background-repeat: no-repeat;
    width: 20em;
    height: 15em;
    top: 1;
    left: 1;
    opacity: 0.25;
    position: absolute;
}
.imagen {
    border: 2px solid black;
    display: flex;
    flex-direction: column;
    text-align: center;
    margin: 0.75em;
    margin-bottom: 0.5em;
    padding: 0.05em;

    @media (min-width: 1024px) {
        .imagen {
            // height: 65vh;
            // width: 65vw;
            margin: 2em;
        }
    }
    @media (min-width: 768px) and (max-width: 1023px) {
        .imagen {
            height: 65vh;
            width: 57vw;
        }
    }
    .opciones {
        display: flex;
        flex-direction: column;
        font-weight: bold;
        border: 1px solid black;
        background-color: #c4c2c2;
        padding: 0.5em;
        .verButton {
            background: none;
            border: 0;
            color: #6704c4;
            margin: 0;
            padding: 0;
            width: 100%;
        }
    }
    img {
        width: 300px;
        height: 200px;
    }

    @media (min-width: 768px) {
        .opciones {
            display: block;
        }
        img {
            width: 400px;
            height: 300px;
        }
    }
}
</style>
