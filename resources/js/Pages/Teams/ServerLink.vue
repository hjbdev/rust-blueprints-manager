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
                <jet-button v-if="!rustPlusSteamData" @click="linkSteam">Begin Server Link</jet-button>
                <div v-if="rustPlusSteamData">
                    <div class="mb-3">
                        <jet-label>Server IP</jet-label>
                        <jet-input type="text" v-model="serverData.ip"></jet-input>
                    </div>

                    <div class="mb-3">
                        <jet-label>Server Port</jet-label>
                        <jet-input type="text" v-model="serverData.port"></jet-input>
                    </div>
                    
                    <jet-button class="mb-3" @click="pairServer">Pair Server</jet-button>

                    <div class="p-5 bg-yellow-500 flex rounded shadow text-white" v-if="pairStatus === 'waiting'">
                        <svg class="animate-spin mr-2" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="currentColor"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 4V1L8 5l4 4V6c3.31 0 6 2.69 6 6 0 1.01-.25 1.97-.7 2.8l1.46 1.46C19.54 15.03 20 13.57 20 12c0-4.42-3.58-8-8-8zm0 14c-3.31 0-6-2.69-6-6 0-1.01.25-1.97.7-2.8L5.24 7.74C4.46 8.97 4 10.43 4 12c0 4.42 3.58 8 8 8v3l4-4-4-4v3z"/></svg>
                        Wait a sec 
                    </div>
                    <div class="p-5 bg-indigo-500 rounded shadow text-white" v-if="pairStatus === 'available'">Click "pair" in the in-game Rust+ menu</div>
                    <div class="p-5 bg-green-500 rounded shadow text-white"    v-if="pairStatus === 'success'">Server paired successfully</div>
                    <div class="p-5 bg-red-500 rounded shadow text-white"    v-if="pairStatus === 'expired'">Expired/An Error Occurred</div>
                </div>
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
    import JetBanner from '@/Jetstream/Banner'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetBanner
        },

        props: ['team'],

        data() {
            return {
                serverData: {
                    ip: this.team.server_ip,
                    port: this.team.server_port,
                    steamId: null,
                    token: null
                },
                pairStatus: null
            }
        },
        
        mounted() {
            if(this.rustPlusSteamData) {
                this.serverData.steamId = this.rustPlusSteamData.steamId;
                this.serverData.token = this.rustPlusSteamData.token;
            }
        },

        methods: {
            linkSteam() {
                window.location.href = 'https://companion-rust.facepunch.com/login?returnUrl=' + encodeURIComponent(window.location.origin + '/rustplus/callback');
            },
            // updateTeamName() {
            //     this.form.put(route('teams.update', this.team), {
            //         errorBag: 'updateTeamName',
            //         preserveScroll: true
            //     });
            // },
            pairServer() {
                this.pairStatus = 'waiting';
                setTimeout(() => {
                    this.pairStatus = 'available';
                }, 10000);
                axios.post('/rustplus/pair', this.serverData).then(response => {
                    this.pairStatus = 'success';
                }).catch(error => {
                    this.pairStatus = 'expired';
                });
            },
        },

        computed: {
            rustPlusSteamData() {
                return this.$page.props.jetstream.flash?.rustPlusSteamData || null
            },
        }
    }
</script>
