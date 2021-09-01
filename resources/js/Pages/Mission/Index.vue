<template>
    <Head title="Missions" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Missions
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <UserMissionSummary :character="$page.props.auth.activeCharacter" />

                        <div class="grid grid-cols-3 gap-4">
                            <div v-for="category in mission_categories" v-bind:key='category.id'>
                                <a :href="route('mission.category', [category.id])" class="block rounded-lg bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 p-5 text-xl font-semibold subpixel-antialiased text-white">
                                    {{ category.name }} ({{ category.missions.length }})
                                </a>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import UserMissionSummary from '@/Components/UserMissionSummary.vue'

export default {
    components: {
        UserMissionSummary,
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        mission_categories: Object
    }
}
</script>
