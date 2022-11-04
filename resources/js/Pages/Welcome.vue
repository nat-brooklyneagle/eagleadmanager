<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import {onMounted, reactive} from 'vue'

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    applicationName: String,
});


onMounted(() => {
    setTimeout(() => {
        show.box = true;
        setTimeout(() => {
            setTimeout(() => {
                show.boxExpand = true;
                setTimeout(() => {
                    show.buttons = true;
                }, show.buttonsTime)
            }, show.expandTime)
        }, show.boxTimePauseAfter)
    }, show.boxTime)
})

const show = reactive({
    box: false,
    boxExpand: false,
    boxTime: 200,
    boxTimePauseAfter: 500,
    buttons: false,
    buttonsTime: 200,
    expandTime: 500,
});
</script>
<template>
    <Head title="Welcome"/>

    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 items-center sm:pt-0">
        <!-- <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
             <Link v-if="$page.props.user" :href="route('dashboard')"
                   class="text-sm text-gray-700 dark:text-gray-200 underline">Dashboard
             </Link>
             <template v-else>
                 <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                 <Link v-if="canRegister" :href="route('register')"
                       class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register
                 </Link>
             </template>
        </div>-->
        <Transition name="fade">
            <div class="select-none bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl shadow-lg shadow-blue-500 border-gray-100 border-4 mx-12 py-16" v-if="show.box">
                <div class="mx-auto max-w-2xl px-4 text-center sm:px-6 lg:px-8 transition-all duration-200" :class="show.boxExpand ? 'h-32' : 'h-16'">
                    <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-7xl">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-gray-100 to-gray-300" v-text="applicationName"/>
                    </h2>
                    <Transition name="fade">
                   <div v-if="show.buttons">
                       <hr class="hidden transition ease-in-out delay-1000 mt-4 border border-dashed"/>
                       <div class="flex justify-center gap-4">
                       <template v-if="$page.props.user">
                           <Link :href="route('dashboard')"
                                 class="mt-8 inline-flex w-full items-center justify-center rounded-md border border-transparent bg-white px-5 py-3 text-base font-medium text-gray-600 hover:bg-gray-50 sm:w-auto">
                               Dashboard
                           </Link>
                       </template>
                       <template v-else>
                           <Link :href="route('login')"
                                 class="mt-8 inline-flex w-full items-center justify-center rounded-md border border-transparent bg-white px-5 py-3 text-base font-medium text-gray-600 hover:bg-gray-50 sm:w-auto">
                               Log in
                           </Link>
                           <Link v-if="canRegister" :href="route('register')"
                                 class="mt-8 inline-flex w-full items-center justify-center rounded-md border border-transparent bg-white px-5 py-3 text-base font-medium text-gray-600 hover:bg-gray-50 sm:w-auto">
                               Register
                           </Link>
                       </template>
                       <!--<Link :href="route('dashboard')"
                             class="text-sm text-gray-700 dark:text-gray-200 underline">Dashboard
                       </Link>
                                   <template v-else>
                                       <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>

                                       <Link v-if="canRegister" :href="route('register')"
                                             class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register
                                       </Link>
                                   </template>-->

                       </div>
                    </div>
                    </Transition>
                </div>
            </div>
        </Transition>
    </div>
</template>
