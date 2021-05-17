<template>
    <div ref="map" class="w-full" style="height: 800px"></div>
</template>
<script>
import L from "leaflet";
import squareGrid from '@turf/square-grid';
import "leaflet/dist/leaflet.css";

export default {
    props: {
        mapData: Object,
        mapUrl: String,
    },
    data() {
        return {
            map: null,
            /* map config */
            mapZoom: 1,
            mapMinZoom: 1,
            mapMaxZoom: 6,
            mapCRS: L.CRS.Simple,
            mapOptions: {
                attributionControl: false,
            },

            rustMapImageUrl: this.mapUrl,
            rustMapImageBounds: null,
            rustMapImageColour: null,
            rustMonuments: [],
            rustMapMarkers: [],
        };
    },
    mounted() {
        this.map = L.map(this.$refs.map, {
            crs: L.CRS.Simple,
            zoom: 5,
            maxZoom: 8,
            minZoom: 5,
            attributionControl: false,
            center: [0, 0]
        });

        this.map.on("contextmenu", function (event) {
            console.log("Coordinates: ", event.latlng.toString());
        });

        const bounds = [
            [0, 0],
            [this.mapData.map_data.height / 150, this.mapData.map_data.width / 150],
        ];
        this.rustMapImageBounds = this.getLatLngBoundsForMapImage(this.mapData.map_data.width, this.mapData.map_data.height);

        var image = L.imageOverlay(this.mapUrl, this.rustMapImageBounds).addTo(this.map);

        console.log(bounds);

        const gridBounds = [
            0 + (this.mapData.map_data.oceanMargin / 150),
            0 + (this.mapData.map_data.oceanMargin / 150),
            (this.mapData.map_data.height / 150) - (this.mapData.map_data.oceanMargin / 150),
            (this.mapData.map_data.width / 150) - (this.mapData.map_data.oceanMargin / 150)
        ];

        console.log(gridBounds);

        const geojson = squareGrid(gridBounds, 55, {
            units: 'kilometers'
        });

        const gridLayer = L.geoJson(geojson, {
            style: {
                weight: 1,
                fillOpacity: 0,
            }
        });

        this.map.addLayer(gridLayer);

        
    },
    methods: {
        getLatLngBoundsForMapImage: function (width, height) {
            // get leaflet map object
            var mapObject = this.map;
            // convert x,y to lat,lng
            var southWest = mapObject.unproject(
                [0, height - this.mapData.map_data.oceanMargin],
                mapObject.getMaxZoom() - 3
            );
            var northEast = mapObject.unproject(
                [width - this.mapData.map_data.oceanMargin, 0],
                mapObject.getMaxZoom() - 3
            );
            // return as latlng bounds
            return new L.LatLngBounds(southWest, northEast);
        },
    },
};
</script>