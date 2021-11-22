<template>
    <Head title="Login" />

    <div class="w-full sm:max-w-lg">
        <div
            class="
                h-full-mobile
                p-5
                flex flex-col
                justify-around
                items-center
                sm:min-h-full
            "
        >
            <div
                class="
                    w-full
                    h-full
                    max-w-sm
                    sm:bg-gradient-to-br
                    sm:from-indigo-300
                    sm:to-indigo-500
                    sm:rounded-lg
                    sm:flex
                    sm:justify-center
                    sm:items-center
                    sm:p-8
                    sm:max-w-full
                "
            >
                <form @submit.prevent="login" class="p-2 flex flex-col w-full">
                    <label-name
                        v-model="form.email"
                        :first="true"
                        type="email"
                        name="email"
                        errorBag="loginErrors"
                        >Email</label-name
                    >
                    <label-name
                        v-model="form.password"
                        type="password"
                        name="password"
                        errorBag="loginErrors"
                        >Password</label-name
                    >
                    <div
                        class="
                            p-2
                            mt-2
                            w-1/2
                            self-end
                            flex
                            justify-end
                            sm:flex-col sm:w-full sm:space-y-8
                        "
                    >
                        <Link
                            :href="route('register')"
                            class="
                                btn
                                hidden
                                p-3
                                shadow-lg
                                w-max
                                bg-gradient-to-br
                                from-indigo-300
                                to-indigo-500
                                text-xs text-left
                                sm:inline-block sm:from-red-300 sm:to-red-500
                            "
                        >
                            No account? Sign Up!
                        </Link>
                        <button
                            type="submit"
                            class="
                                btn
                                bg-gradient-to-br
                                from-indigo-300
                                to-indigo-500
                                italics
                                border-none
                                shadow-lg
                                sm:text-right
                                sm:inline-block
                                sm:from-red-300
                                sm:to-red-500
                                sm:w-max
                                sm:self-end
                            "
                        >
                            Sign in!
                        </button>
                    </div>
                </form>
            </div>
            <div class="w-full flex justify-center sm:hidden">
                <Link
                    :href="route('register')"
                    class="
                        p-5
                        inline-block
                        shadow-lg
                        w-9/12
                        text-center
                        rounded-full
                        bg-gradient-to-br
                        text-white text-lg
                        uppercase
                        from-indigo-300
                        to-indigo-500
                    "
                >
                    No account? Sign Up!
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import LabelName from "@/components/FormElements/LabelName.vue";
import AppLayoutVue from "@/Layouts/AppLayout.vue";

export default defineComponent({
    components: {
        Head,
        Link,
        LabelName,
    },
    layout: AppLayoutVue,

    props: {
        canResetPassword: Boolean,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: "",
                password: "",
                remember: false,
            }),
        };
    },

    methods: {
        login(event) {
            axios.get("/sanctum/csrf-cookie").then(() => {
                this.form
                    .transform((data) => ({ ...data }))
                    .post(route("login"), {
                        onFinish: () => {
                            this.form.reset();
                        },
                    });
            });
        },
    },
});
</script>
