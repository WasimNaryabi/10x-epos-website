<template>
    <div class="app-wrapper">
        <!-- Navbar -->
        <Navbar @request-demo="openDemoModal" />

        <!-- Main Content -->
        <main class="main-content">
            <!-- Hero Section -->
            <Hero 
                @request-demo="openDemoModal"
                @contact-sales="scrollToContact"
            />

            <!-- Features Section -->
            <Features @request-demo="openDemoModal" />

            <!-- Pricing Section -->
            <!-- <Pricing @request-demo="openDemoModal" /> -->

            <!-- Testimonials -->
            <Testimonials />

             <!-- Screenshots Gallery -->
            <Screenshots @request-demo="openDemoModal" />

            <!-- Partners -->
            <Partners @contact-sales="scrollToContact" />

            <!-- Contact Section -->
            <Contact 
                ref="contactSection"
                @form-submitted="handleContactSubmit"
            />
        </main>

        <!-- Footer -->
        <Footer/>

        <!-- Demo Request Modal -->
        <DemoRequestModal 
            :show="showDemoModal"
            @close="showDemoModal = false"
            @submitted="handleDemoSubmit"
        />

        <!-- Success Toast -->
        <Transition name="slide-fade">
            <SuccessToast 
                v-if="showSuccessToast"
                :message="successMessage"
                @close="showSuccessToast = false"
            />
        </Transition>

        <!-- Scroll to Top Button -->
        <button 
            v-if="showScrollTop"
            @click="scrollToTop"
            class="scroll-top-btn"
        >
        <Icon name="chevron-up" :size="24" color="white" />
        </button>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Icon from '@/Components/Shared/Icon.vue';
import Navbar from '@/Components/Shared/Navbar.vue';
import Hero from '@/Components/Website/Hero.vue';
import Features from '@/Components/Website/Features.vue';
import Screenshots from '@/Components/Website/Screenshots.vue';
import Pricing from '@/Components/Website/Pricing.vue';
import Testimonials from '@/Components/Website/Testimonials.vue';
import Partners from '@/Components/Website/Partners.vue';
import Contact from '@/Components/Website/Contact.vue';
import Footer from '@/Components/Shared/Footer.vue';
import DemoRequestModal from '@/Components/Website/DemoRequestModal.vue';
import SuccessToast from '@/Components/Shared/SuccessToast.vue';
import AOS from 'aos';
import 'aos/dist/aos.css';

// Reactive state
const showDemoModal = ref(false);
const showSuccessToast = ref(false);
const successMessage = ref('');
const contactSection = ref(null);
const showScrollTop = ref(false);

// Initialize AOS animations
onMounted(() => {
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });

    window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});

// Methods
const openDemoModal = () => {
    showDemoModal.value = true;
};

const scrollToContact = () => {
    contactSection.value?.$el.scrollIntoView({ 
        behavior: 'smooth',
        block: 'start'
    });
};

const handleContactSubmit = (message) => {
    successMessage.value = message || 'Thank you for contacting us! We\'ll get back to you within 24 hours.';
    showSuccessToast.value = true;
    
    setTimeout(() => {
        showSuccessToast.value = false;
    }, 5000);
};

const handleDemoSubmit = (message) => {
    showDemoModal.value = false;
    successMessage.value = message || 'Demo request submitted successfully! We\'ll contact you soon.';
    showSuccessToast.value = true;
    
    setTimeout(() => {
        showSuccessToast.value = false;
    }, 5000);
};

const handleScroll = () => {
    showScrollTop.value = window.scrollY > 300;
};

const scrollToTop = () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
};
</script>

<style scoped>
/* App Wrapper */
.app-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background: white;
}

/* Main Content */
.main-content {
    flex: 1;
    padding-top: 80px; /* Space for fixed navbar */
}

/* Transition animations */
.slide-fade-enter-active {
    transition: all 0.3s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.3s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}

/* Scroll to Top Button */
.scroll-top-btn {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    box-shadow: 0 4px 20px rgba(102, 126, 234, 0.4);
    transition: all 0.3s;
    z-index: 999;
}

.scroll-top-btn:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.5);
}

@media (max-width: 768px) {
    .main-content {
        padding-top: 70px;
    }

    .scroll-top-btn {
        bottom: 1rem;
        right: 1rem;
        width: 45px;
        height: 45px;
    }
}
</style>