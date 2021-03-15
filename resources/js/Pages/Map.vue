<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Map
                </h2>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <RMap :map-data="mapData" :map-url="mapUrl"></RMap>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import RMap from '@/BlueprintsManager/Map';
    // import JetButton from '@/Jetstream/Button';

    export default {
        props: {
            mapData: Object,
            mapUrl: String
        },
        components: {
            AppLayout, RMap
        },
    }
</script>
