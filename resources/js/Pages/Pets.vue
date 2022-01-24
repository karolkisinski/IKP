<template>
    <pages-layout>
        <template #title>
            <div class="flex justify-between items-center w-full">
                <h2 class="flex items-end font-semibold text-xl text-gray-800 leading-tight">
                    <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.username"
                         class="h-20 w-20 rounded-full object-cover">
                    <span class="capitalize m1-3">
                        Pets
                    </span>
                </h2>
            </div>
        </template>
        <pets :pets="pets">

        </pets>
    </pages-layout>
</template>

<script>
import { defineComponent } from 'vue'
import PagesLayout from '@/Layouts/PagesLayout.vue'
import Pets from '@/Components/Pets/PetsShow'

export default defineComponent({
    props: ['pets'],
    components: {
        PagesLayout,
        Pets,
    },
})
</script>
