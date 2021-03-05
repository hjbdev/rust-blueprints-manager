<template>
    <app-layout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Blueprints
                </h2>
                <div>
                    <inertia-link href="/blueprints/research">
                        <jet-button>Research</jet-button>
                    </inertia-link>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <blueprints-table :blueprints="blueprints"></blueprints-table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import BlueprintsTable from '@/BlueprintsManager/Blueprints/Table';
    import JetButton from '@/Jetstream/Button';

    export default {
        components: {
            AppLayout, BlueprintsTable, JetButton
        },
        props: {
            blueprints: {
                type: Array,
                required: true
            }
        }
    }
</script>
