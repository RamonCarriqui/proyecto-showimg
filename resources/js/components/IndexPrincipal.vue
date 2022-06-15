<template>
    <div>
        <!-- Componente Menu Lateral -->
        <MenuLateralVue id="menuLateral"></MenuLateralVue>

        <!-- Las fotos se maquetaran en un VTable, aportando asi cierta estructura y se aprovecha la funcion de paginación VTPagination-->
        <VTable
            :data="items"
            id="mainImagenes"
            :page-size="24"
            v-model:currentPage="currentPage"
            @totalPagesChanged="totalPages = $event"
        >
            <template #body="{ rows }">
                <div id="result">
                    <!-- Componente ImgCard que se generara por cada imagen/foto obtenida -->
                    <ImgCard
                        v-for="photo in rows"
                        :key="photo.id"
                        v-bind:photo="photo"
                    />
                    <!--Si la variable error esta true se mostrara una imagen de error-->
                    <div v-if="error">
                        <img src="/img/error.png" alt="ERROR 404" />
                    </div>
                </div>
            </template>
        </VTable>
        <VTPagination
            id="paginacion"
            class="d-flex justify-content-center"
            v-model:currentPage="currentPage"
            :total-pages="totalPages"
            :boundary-links="true"
        />
    </div>
</template>
<script>
import MenuLateralVue from "./MenuLateral.vue";
import ImgCard from "./ImgCard.vue";

export default {
    components: { MenuLateralVue, ImgCard },
    data() {
        return {
            items: [], // Variable donde se guardaran las fotos/imagenes de la API
            error: false, // Variable que se inicia en false, si hay error en busquedaImagen(query) se volvera true
            totalPages: 1, // Numero total de paginas, se establece en 1 (documentación del modulo vue-smart-table)
            currentPage: 1, // Pagina actual, se establece en 1 (documentación del modulo vue-smart-table)
        };
    },
    mounted() {
        // Cuando se monte la vista
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);
        var query = urlParams.get("query"); // Se obtendra la query por la url
        this.busquedaImagen(query); // Se inicia una busqueda de imagenes
    },
    computed: {},
    methods: {
        busquedaImagen(query, page = null) {
            if (query == null || query == "") {
                // Si la query obtenida tiene no tiene valor o es null
                var url = // La url sera igual a una url de busqueda API preestablecida
                    "https://api.pexels.com/v1/search?query=principal&locale=es-ES&per_page=80";
            } else {
                var url = // La url sera igual a una url de busqueda API especificada por el usuario
                    "https://api.pexels.com/v1/search?query=" +
                    query +
                    "&locale=es-ES&per_page=80";
            }

            $.ajax({
                beforeSend: function (xhr) {
                    xhr.setRequestHeader(
                        "Authorization",
                        "563492ad6f91700001000001d77aff73dbb641b3989bf88d0088d163"
                    );
                },
                method: "GET",
                url: url,
                success: (data) => {
                    console.log(data);
                    // Dependidendo del resultado
                    if (data.photos == 0) {
                        // Si los datos no contienen fotos
                        this.error = true; // Activamos la variable de error
                    } else {
                        console.log(data.photos); // Console.log para ver como nos llegan
                        this.items = data.photos; // Guardamos las fotos en items
                    }
                },
            });
        },
    },
};
</script>

<style lang="scss" scoped>
#main {
    margin-top: 2em;
    @media (min-width: 768px) {
        display: grid;
        grid-template-areas:
            "menuLateral mainImagenes"
            "menuLateral paginacion";
        grid-template-columns: 20% 80%;
        row-gap: 2em;
    }

    #menuLateral {
        grid-area: menuLateral;
    }
    #mainImagenes {
        grid-area: mainImagenes;
        width: 100%;
        #result {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            align-content: center;
            justify-content: center;
            margin-bottom: 2em;
        }

        @media (min-width: 768px) {
            #result {
                flex-direction: row;
                flex-wrap: wrap;
                align-content: space-around;
                margin-bottom: 0;
            }
        }
    }
    #paginacion {
        grid-area: paginacion;
    }
}
</style>
