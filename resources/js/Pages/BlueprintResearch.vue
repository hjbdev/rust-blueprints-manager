<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Learn a Blueprint
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <div class="mb-3">
                        <jet-label for="blueprint">Blueprint Name</jet-label>
                        <input v-model="form.blueprint" type="text" id="blueprint" name="blueprint" required list="blueprint-list" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" />  
                        <datalist id="blueprint-list">
                            <option v-for="blueprint in blueprints" :value="blueprint.name" :key="`blueprint${blueprint.id}`">{{ blueprint.display_name }}</option>
                        </datalist>
                        <jet-input-error :message="form.errors.blueprint" class="mt-2"></jet-input-error>
                    </div>
                    <div class="mb-3">
                        <jet-label for="user">User</jet-label>
                        <input v-model="form.user" type="text" id="user" name="user" required list="user-list" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" />  
                        <datalist id="user-list">
                            <option v-for="user in teammates" :value="user.id" :key="`user${user.id}`">{{ user.name }}</option>
                        </datalist>
                        <jet-input-error :message="form.errors.user" class="mt-2"></jet-input-error>
                    </div>
                    <div class="flex justify-end">
                        <jet-button @click="submit">Save</jet-button>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import JetButton from '@/Jetstream/Button';
    import JetInput from '@/Jetstream/Input';
    import JetLabel from '@/Jetstream/Label';
    import JetInputError from '@/Jetstream/InputError';

    export default {
        props: {
            blueprints: {
                type: Array,
                required: true
            },
            teammates: {
                type: Array,
                required: true
            }
        },
        data() { 
            return {
                form: this.$inertia.form({
                    blueprint: null,
                    user: null
                })
            }
        },
        methods: {
            submit() {
                this.form.post('/blueprints/research', {
                    errorBag: 'default'
                });
            }
        },
        components: {
            AppLayout, JetButton, JetInput, JetLabel, JetInputError
        },
    }
</script>
