<template>
    <div>
        {{ pet.name }} {{ pet.race }} {{ pet.age }}
    </div>
</template>

<script>
    export default {
        props: ['pet'],
    }
</script>
