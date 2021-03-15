<template>
    <jet-form-section @submitted="updateTeamName">
        <template #title>
            Link Server
        </template>

        <template #description>
            Link your team to a server to enable more features.
        </template>

        <template #form>
            <!-- Server Pair Button -->
            <div class="col-span-6">
                <jet-button v-if="!rustPlusSteamData" @click="pairServer">Begin Server Link</jet-button>
                <jet-button v-if="rustPlusSteamData">Pair Server</jet-button>
            </div>
        </template>

        <!-- <template #actions> -->
            <!-- <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message> -->

            <!-- <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button> -->
        <!-- </template> -->
    </jet-form-section>
</template>

<script>
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetButton from '@/Jetstream/Button'
    import JetFormSection from '@/Jetstream/FormSection'
    import JetInput from '@/Jetstream/Input'
    import JetInputError from '@/Jetstream/InputError'
    import JetLabel from '@/Jetstream/Label'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
        },

        // props: ['team', 'permissions'],

        data() {
            return {
                form: this.$inertia.form({
                })
            }
        },

        methods: {
            pairServer() {
                window.location.href = 'https://companion-rust.facepunch.com/login?returnUrl=' + encodeURIComponent(window.location.origin + '/rustplus/callback');
            }
            // updateTeamName() {
            //     this.form.put(route('teams.update', this.team), {
            //         errorBag: 'updateTeamName',
            //         preserveScroll: true
            //     });
            // },
        },

        computed: {
            rustPlusSteamData() {
                return this.$page.props.jetstream.flash?.rustPlusSteamData || null
            },
        }
    }
</script>
