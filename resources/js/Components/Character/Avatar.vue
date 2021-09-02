<template>
    <div v-if="character" class="relative">
        <img :src="'/img/nation/' + character.nation + '.jpg'" :alt="character.nation" width="15" class="absolute bottom-0 left-0" />
        <img :src="'/img/character/' + character.look.avatar + '.jpeg'" :alt="character.look.avatar" width="100" :class="'object-fill rounded-lg border-2 border-' + character.nation_color + '-700'" />
    </div>
</template>

<script>

export default {
    props: ['character'],
}

</script>