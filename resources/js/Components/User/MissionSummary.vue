<template>
    <div class="" v-if="character">
        <div class="flex flex-row gap-4">
            <div class="flex-grow">
                <div class="text-2xl pb-1">
                    Active missions: {{ $page.props.auth.user.active_mission_count }}/3
                </div>

                <div v-if="missions.length == 0">
                    <Loading  />
                </div>
                <div v-for="mission in missions" v-bind:key='mission.id'>
                    <MissionProgressBar :mission='mission' />
                </div>

            </div>
        </div> 
    </div>
</template>

<script>

import Loading from '@/Components/Loading.vue'
import MissionProgressBar from '@/Components/Mission/ProgressBar.vue'

export default {

    components: {
        Loading,
        MissionProgressBar
    },

    props: ['character'],

    data () {
        return {
            missions: [],
        }
    },
    mounted() {
        this.loadMissions();
    },
    methods: {
        loadMissions () {
                axios
                    .get('/mission/active')
                    .then(response => (this.missions = Object.values(response.data)));
            }
    }
}
</script>