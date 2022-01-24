<template>
    <div>
        <div v-for="(pet, key) in pets" :key="key">
            <pet-item :pet="pet"></pet-item>
        </div>
    </div>
</template>

<script>
    import PetItem from './PetItem'
    export default {
        props: ['pets'],
        components: {
            PetItem,
        }
    }
</script>
