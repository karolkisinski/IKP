<template>
    <pages-layout>
        <template #title>
            <div class="flex justify-between items-center w-full">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.username"
                         class="h-20 w-20 rounded-full object-cover">
                    <span class="capitalize m1-3">
                        Admin page
                        <div id="petsCount">Pets in database {{ pets.length }}</div>
                    </span>
                </h2>
            </div>
        </template>
    </pages-layout>
</template>

<script>
import { defineComponent } from 'vue'
import PagesLayout from '@/Layouts/PagesLayout.vue'
import PetItem from '@/Components/Pets/PetItem'

export default defineComponent({
    props: ['pets'],
    components: {
        PagesLayout,
        PetItem,
    },
    beforeMount() {
        console.log(this.pets.length);
    },
    petsCount() {
        document.getElementById("#petsCount").innerHTML = count(this.pets);
    }
})
</script>
