<template>
    <Head title="Characters" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Characters
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <ul id="characters">
                            <li v-for="character in characters" :key="character.charid">
                                <Avatar :character='character' />
                                {{ character.charname }} - {{ character.zone.name }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';

import Avatar from '@/Components/Character/Avatar.vue'

export default {
    components: {
        Avatar,
        BreezeAuthenticatedLayout,
        Head,
    },
    props: {
        characters: Object,
    },
}
</script>
