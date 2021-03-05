<template>
    <div>
        <div class="p-6 border-b">
            <jet-input v-model="search" type="text" placeholder="Search"></jet-input>
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div
                    class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
                >
                    <div
                        class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                    >
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Item Name
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Item Shortname
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Researched By
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                    >
                                        Workbench Level
                                    </th>
                                    <th
                                        scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-5"
                                    >
                                        
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr
                                    v-for="blueprint in filteredBlueprints"
                                    :key="`blueprintRow${blueprint.id}`"
                                >
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                                    >
                                        {{ blueprint.display_name }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{ blueprint.name }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        {{
                                            blueprint.teammates
                                                .map((user) => user.name)
                                                .join(", ")
                                        }}
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        <span
                                            v-if="blueprint.workbench_level > 0"
                                            class="px-1 py-0 5 rounded font-bold"
                                            :class="
                                                workbenchClasses(
                                                    blueprint.workbench_level
                                                )
                                            "
                                            >Workbench Level
                                            {{
                                                blueprint.workbench_level
                                            }}</span
                                        >
                                        <span v-else>Workbench Not Needed</span>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                                    >
                                        <a href="#" @click="del(blueprint.id)" class="text-gray-500 hover:text-gray-800 transition duration-100" v-show="blueprint.user_knows">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import JetInput from '@/Jetstream/Input';
export default {
    components: {JetInput},
    props: {
        blueprints: {
            type: Array,
        }
    },
    data() {
        return {
            search: ''
        }
    },
    computed: {
        filteredBlueprints() {
            return this.blueprints.filter(item => {
                return item.display_name.toLowerCase().includes(this.search) || item.name.toLowerCase().includes(this.search);
            });
        }
    },
    methods: {
        workbenchClasses(tier) {
            if(tier === 1) {
                return 'bg-green-200 text-green-500';
            }
            if(tier === 2) {
                return 'bg-blue-200 text-blue-500';
            }
            if(tier === 3) {
                return 'bg-red-200 text-red-500';
            }
        },
        del(id) {
            this.$inertia.delete(`/blueprints/${id}`);
        }
    }
}
</script>