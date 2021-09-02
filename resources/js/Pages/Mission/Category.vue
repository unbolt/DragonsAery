

<template>
    <Head title="Missions" />


    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <a :href="route('mission.index')">
                    Missions
                </a>
                / {{ category.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">


                        Here there be missions
                        <div v-for="mission in missions" v-bind:key='mission.id'>
                            {{ mission.category.name }} / {{ mission.name }}

                            <button @click='startMission(mission.id)'>Start</button>

                            <div v-for="reward in mission.rewards" v-bind:key='reward.id'>
                                {{ reward.item.en_name }}
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        category: Object,
        missions: Object
    },
    methods: {
        startMission(id) {
            axios.post('/mission/start/' + id)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.error('There was an error!', error);
                });
        }
    }
}
</script>
