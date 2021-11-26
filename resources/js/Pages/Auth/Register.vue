<template>
    <Head title="Register" />
    <div class="w-full mx-auto sm:max-w-lg">
        <div
            class="
                h-full-mobile
                p-5
                flex flex-col
                justify-between
                items-center
                overflow-y-scroll
                sm:min-h-full
            "
        >
            <div
                class="
                    w-full
                    flex-grow flex
                    max-w-sm
                    sm:bg-gradient-to-br
                    sm:from-indigo-300
                    sm:to-indigo-500
                    sm:rounded-lg
                    sm:justify-center
                    sm:items-center
                    sm:p-8
                    sm:max-w-full
                "
            >
                <form
                    ref="form"
                    @submit.prevent="register"
                    class="
                        p-2
                        flex
                        w-full
                        overflow-x-hidden
                        sm:flex-col sm:overflow-x-visible
                    "
                >
                    <div
                        class="
                            transform
                            transition-transform
                            flex flex-col
                            justify-center
                            min-w-full
                            sm:-translate-x-0
                        "
                    >
                        <label-name
                            v-model="form.name"
                            :first="true"
                            type="text"
                            name="name"
                            errorBag="signUpErrors"
                            ref="name"
                            >Username</label-name
                        >
                        <label-name
                            v-model="form.email"
                            type="email"
                            errorBag="signUpErrors"
                            name="email"
                            ref="email"
                            >Email</label-name
                        >
                        <div
                            class="
                                p-2
                                mt-2
                                w-1/2
                                self-end
                                flex
                                justify-center
                                sm:hidden
                            "
                        >
                            <button
                                @click.prevent.stop="continueForm"
                                type="button"
                                class="
                                    btn
                                    bg-gradient-to-br
                                    from-indigo-300
                                    to-indigo-500
                                    italics
                                    border-none
                                    shadow-lg
                                "
                            >
                                Proceed!
                            </button>
                        </div>
                    </div>
                    <div
                        class="
                            transform
                            transition-transform
                            flex flex-col
                            justify-center
                            min-w-full
                            sm:-translate-x-0
                        "
                    >
                        <label-name
                            v-model="form.password"
                            type="password"
                            name="password"
                            errorBag="signUpErrors"
                            >Password</label-name
                        >
                        <label-name
                            v-model="form.password_confirmation"
                            type="password"
                            name="password_confirmation"
                            errorBag="signUpErrors"
                            >Password Confirmation</label-name
                        >
                        <div
                            class="
                                p-2
                                mt-2
                                w-full
                                self-end
                                flex
                                justify-around
                                sm:flex-col sm:space-y-4
                            "
                        >
                            <button
                                @click.prevent.stop="goBack"
                                type="button"
                                class="
                                    btn
                                    bg-gradient-to-br
                                    from-indigo-300
                                    to-indigo-500
                                    italics
                                    border-none
                                    shadow-lg
                                    sm:hidden
                                "
                                ref="go_back"
                            >
                                Go back!
                            </button>

                            <Link
                                :href="route('login')"
                                class="
                                    hidden
                                    shadow-lg
                                    text-center
                                    bg-gradient-to-br
                                    from-indigo-300
                                    to-indigo-500
                                    sm:btn
                                    sm:p-2
                                    sm:w-max
                                    sm:text-xs
                                    sm:rounded-lg
                                    sm:from-red-300
                                    sm:to-red-500
                                "
                            >
                                Have an account? Login!
                            </Link>
                            <button
                                type="submit"
                                class="
                                    btn
                                    bg-gradient-to-br
                                    from-red-400
                                    to-red-600
                                    italics
                                    border-none
                                    shadow-lg
                                    sm:w-max sm:self-end
                                "
                            >
                                Sign up!
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <transition
                enter-active-class="ease-in duration-500 delay-150"
                enter-from-class="opacity-0"
                enter-to-class="opacity-100"
            >
                <div
                    v-show="proceeded"
                    class="
                        flex-grow
                        w-full
                        flex flex-col
                        justify-center
                        items-center
                        sm:hidden
                    "
                >
                    <span
                        v-show="form.name"
                        class="
                            w-10/12
                            p-1
                            bg-gradient-to-br
                            from-indigo-300
                            to-indigo-500
                            text-white text-sm text-center
                            rounded-full
                        "
                        >{{ form.name }}</span
                    >
                    <span
                        v-show="form.email"
                        class="
                            mt-2
                            w-10/12
                            p-1
                            bg-gradient-to-br
                            from-indigo-300
                            to-indigo-500
                            text-white text-sm text-center
                            rounded-full
                        "
                        >{{ form.email }}</span
                    >
                </div>
            </transition>
            <div class="w-full max-w-sm mt-8 sm:hidden">
                <Link
                    :href="route('login')"
                    class="
                        p-5
                        inline-block
                        shadow-lg
                        w-full
                        text-center
                        rounded-full
                        bg-gradient-to-br
                        text-white text-base
                        uppercase
                        from-indigo-300
                        to-indigo-500
                    "
                >
                    Have an account? Login!
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import AppLayoutVue from "@/Layouts/AppLayout.vue";
import LabelName from "@/components/FormElements/LabelName.vue";

export default defineComponent({
    components: {
        Head,
        Link,
        LabelName,
    },
    layout: AppLayoutVue,

    data() {
        return {
            form: this.$inertia.form({
                name: "",
                email: "",
                password: "",
                password_confirmation: "",
            }),
            proceeded: false,
        };
    },

    methods: {
        register() {
            axios.get("/sanctum/csrf-cookie").then(() => {
                this.form
                    .transform((data) => ({ ...data }))
                    .post(route("register"), {
                        onError: () => {
                            this.$refs.go_back.click();
                        },
                        onFinish: (page) => {
                            this.form.reset('email');
                        },
                    });
            });
        },
        continueForm() {
            if (!this.form.name) {
                this.$refs.name.$refs.input.focus();
                return;
            }
            if (!this.form.email) {
                this.$refs.email.$refs.input.focus();
                return;
            }

            Array.from(this.$refs.form.children).forEach((child) =>
                child.classList.add("-translate-x-full")
            );
            this.proceeded = true;
        },
        goBack() {
            Array.from(this.$refs.form.children).forEach((child) =>
                child.classList.remove("-translate-x-full")
            );
        },
    },
});
</script>
