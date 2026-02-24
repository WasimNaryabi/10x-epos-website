<template>
    <div class="app-wrapper">
        <!-- Navbar -->
        <Navbar @request-demo="openDemoModal" />

        <!-- Main Content -->
        <main class="main-content">
            <!-- Hero Section -->
            <section class="hero">
                <div class="container">
                    <h1 class="hero-title" data-aos="fade-up">Help Center</h1>
                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
                        Find answers to common questions and learn how to get the most out of 10x Global
                    </p>

                    <!-- Search Bar -->
                    <div class="search-box" data-aos="fade-up" data-aos-delay="200">
                        <Icon name="search" :size="20" color="gray" />
                        <input 
                            type="text" 
                            v-model="searchQuery"
                            placeholder="Search for help articles..."
                            @input="handleSearch"
                        />
                    </div>
                </div>
            </section>

            <!-- Quick Links -->
            <section class="section quick-links">
                <div class="container">
                    <div class="quick-links-grid">
                        <div 
                            v-for="(link, index) in quickLinks" 
                            :key="index"
                            class="quick-link-card"
                            data-aos="fade-up"
                            :data-aos-delay="index * 50"
                        >
                            <div class="quick-link-icon">
                                <Icon :name="link.icon" :size="32" color="white" />
                            </div>
                            <h3>{{ link.title }}</h3>
                            <p>{{ link.description }}</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- FAQ Sections -->
            <section class="section faq-section">
                <div class="container">
                    <h2 class="section-title" data-aos="fade-up">Frequently Asked Questions</h2>

                    <div class="faq-categories">
                        <!-- Category Tabs -->
                        <div class="category-tabs" data-aos="fade-up">
                            <button 
                                v-for="category in faqCategories" 
                                :key="category.id"
                                @click="activeCategory = category.id"
                                :class="['category-tab', { active: activeCategory === category.id }]"
                            >
                                {{ category.name }}
                            </button>
                        </div>

                        <!-- FAQ Items -->
                        <div class="faq-list">
                            <div 
                                v-for="(faq, index) in filteredFaqs" 
                                :key="index"
                                class="faq-item"
                                data-aos="fade-up"
                                :data-aos-delay="index * 50"
                            >
                                <button 
                                    class="faq-question"
                                    @click="toggleFaq(index)"
                                    :class="{ active: activeFaq === index }"
                                >
                                    <span>{{ faq.question }}</span>
                                    <Icon 
                                        :name="activeFaq === index ? 'chevron-up' : 'chevron-down'" 
                                        :size="20" 
                                        color="primary" 
                                    />
                                </button>
                                <Transition name="faq-expand">
                                    <div v-if="activeFaq === index" class="faq-answer">
                                        <p v-html="faq.answer"></p>
                                    </div>
                                </Transition>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Contact Support CTA -->
            <section class="section support-cta">
                <div class="container">
                    <div class="cta-card" data-aos="zoom-in">
                        <h2>Still need help?</h2>
                        <p>Our support team is here to assist you 24/7</p>
                        <div class="cta-buttons">
                            <router-link to="/contact-support" class="btn-primary">
                                Contact Support
                                <Icon name="arrow-right" :size="20" color="white" />
                            </router-link>
                            <button @click="openDemoModal" class="btn-secondary">
                                Request Demo
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <Footer />

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
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Icon from '@/Components/Shared/Icon.vue';
import Navbar from '@/Components/Shared/Navbar.vue';
import Footer from '@/Components/Shared/Footer.vue';
import DemoRequestModal from '@/Components/Website/DemoRequestModal.vue';
import SuccessToast from '@/Components/Shared/SuccessToast.vue';
import AOS from 'aos';
import 'aos/dist/aos.css';

// State
const showDemoModal = ref(false);
const showSuccessToast = ref(false);
const successMessage = ref('');
const searchQuery = ref('');
const activeCategory = ref('getting-started');
const activeFaq = ref(null);

// Quick Links
const quickLinks = ref([
    {
        icon: 'rocket',
        title: 'Getting Started',
        description: 'Learn the basics of setting up your EPOS system'
    },
    {
        icon: 'settings',
        title: 'System Setup',
        description: 'Configure your system settings and preferences'
    },
    {
        icon: 'users',
        title: 'User Management',
        description: 'Add and manage staff accounts and permissions'
    },
    {
        icon: 'headset',
        title: '24/7 Support',
        description: 'Get help from our dedicated support team'
    }
]);

// FAQ Categories
const faqCategories = ref([
    { id: 'getting-started', name: 'Getting Started' },
    { id: 'payments', name: 'Payments' },
    { id: 'inventory', name: 'Inventory' },
    { id: 'reports', name: 'Reports' },
    { id: 'troubleshooting', name: 'Troubleshooting' }
]);

// FAQ Data
const faqs = ref([
    {
        category: 'getting-started',
        question: 'How do I set up my 10x Global for the first time?',
        answer: 'Setting up is easy! After installation, log in with your credentials, configure your business details, add your menu items, set up payment methods, and you\'re ready to go. Our setup wizard will guide you through each step.'
    },
    {
        category: 'getting-started',
        question: 'What hardware do I need to run 10x Global?',
        answer: 'You need an Android tablet (recommended 10" or larger), a receipt printer with network or USB connection, and optionally a cash drawer and barcode scanner. Contact our sales team for recommended hardware packages.'
    },
    {
        category: 'getting-started',
        question: 'Can I import my existing menu from another system?',
        answer: 'Yes! We support CSV imports from most major EPOS systems. Our support team can help you migrate your data seamlessly.'
    },
    {
        category: 'payments',
        question: 'What payment methods are supported?',
        answer: 'We support cash, card payments (Stripe, SumUp), contactless payments, mobile wallets (Apple Pay, Google Pay), and split payments. All payment data is encrypted and PCI-compliant.'
    },
    {
        category: 'payments',
        question: 'How do I process a refund?',
        answer: 'Go to Order History, select the transaction, click "Refund", choose full or partial refund, and confirm. The refund will be processed to the original payment method within 3-5 business days.'
    },
    {
        category: 'payments',
        question: 'Are my payment transactions secure?',
        answer: 'Absolutely. All transactions are encrypted end-to-end with 256-bit SSL encryption. We are fully PCI-DSS compliant and never store full card details on our servers.'
    },
    {
        category: 'inventory',
        question: 'How does inventory tracking work?',
        answer: 'Our system automatically tracks stock levels with each sale. Set low-stock alerts, manage suppliers, track ingredient usage, and generate purchase orders automatically when items run low.'
    },
    {
        category: 'inventory',
        question: 'Can I track ingredients for recipes?',
        answer: 'Yes! Create recipes with ingredient lists, and the system will automatically deduct ingredients from stock when menu items are sold. Perfect for tracking food costs accurately.'
    },
    {
        category: 'inventory',
        question: 'How do I perform a stock take?',
        answer: 'Navigate to Inventory > Stock Take, scan items or manually enter quantities, and the system will automatically adjust stock levels and highlight discrepancies.'
    },
    {
        category: 'reports',
        question: 'What reports are available?',
        answer: 'Access sales reports, inventory reports, staff performance, hourly breakdowns, payment summaries, product performance, and custom reports. All reports can be exported to CSV or PDF.'
    },
    {
        category: 'reports',
        question: 'Can I access reports remotely?',
        answer: 'Yes! Log in to your cloud dashboard from any device to view real-time reports, sales data, and analytics from anywhere in the world.'
    },
    {
        category: 'reports',
        question: 'How far back can I view historical data?',
        answer: 'All your data is stored indefinitely. You can access and analyze historical data from day one of using the system.'
    },
    {
        category: 'troubleshooting',
        question: 'What should I do if my printer is not working?',
        answer: 'Check the printer connection (USB/Network), ensure it has paper and is powered on, restart the printer and tablet, and verify printer settings in System > Devices. If issues persist, contact support.'
    },
    {
        category: 'troubleshooting',
        question: 'The system is running slowly, what can I do?',
        answer: 'Clear the app cache (Settings > Apps > Clear Cache), ensure you have a stable internet connection, restart the tablet, and make sure you\'re running the latest version of the app.'
    },
    {
        category: 'troubleshooting',
        question: 'How do I get technical support?',
        answer: 'Contact us 24/7 via phone, email, or live chat. Our support team typically responds within 15 minutes and can remotely access your system (with permission) to resolve issues quickly.'
    }
]);

// Computed
const filteredFaqs = computed(() => {
    return faqs.value.filter(faq => faq.category === activeCategory.value);
});

// Methods
const openDemoModal = () => {
    showDemoModal.value = true;
};

const handleDemoSubmit = (message) => {
    showDemoModal.value = false;
    successMessage.value = message || 'Demo request submitted successfully!';
    showSuccessToast.value = true;
    
    setTimeout(() => {
        showSuccessToast.value = false;
    }, 5000);
};

const toggleFaq = (index) => {
    activeFaq.value = activeFaq.value === index ? null : index;
};

const handleSearch = () => {
    // Implement search functionality
    console.log('Searching for:', searchQuery.value);
};

onMounted(() => {
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
});
</script>

<style scoped>
/* App Wrapper */
.app-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background: white;
}

.main-content {
    flex: 1;
    padding-top: 128px; /* Navbar + Banner */
}

/* Hero Section */
.hero {
    padding: 4rem 2rem;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    text-align: center;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
}

.hero-title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 800;
    margin-bottom: 1rem;
}

.hero-subtitle {
    font-size: clamp(1.1rem, 2vw, 1.3rem);
    opacity: 0.95;
    margin-bottom: 3rem;
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
}

.search-box {
    max-width: 600px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 1rem;
    background: white;
    padding: 1rem 1.5rem;
    border-radius: 50px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.search-box input {
    flex: 1;
    border: none;
    outline: none;
    font-size: 1rem;
    color: #0f172a;
}

.search-box input::placeholder {
    color: #64748b;
}

/* Quick Links */
.quick-links {
    padding: 5rem 2rem;
    background: #f8fafc;
}

.quick-links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.quick-link-card {
    background: white;
    padding: 2.5rem;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    cursor: pointer;
}

.quick-link-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(26, 11, 94, 0.15);
}

.quick-link-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.quick-link-card h3 {
    font-size: 1.3rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.75rem;
}

.quick-link-card p {
    color: #64748b;
    line-height: 1.6;
}

/* FAQ Section */
.faq-section {
    padding: 5rem 2rem;
    background: white;
}

.section-title {
    text-align: center;
    font-size: clamp(2rem, 4vw, 2.5rem);
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 3rem;
}

.category-tabs {
    display: flex;
    gap: 1rem;
    margin-bottom: 3rem;
    flex-wrap: wrap;
    justify-content: center;
}

.category-tab {
    padding: 0.75rem 1.5rem;
    background: white;
    border: 2px solid #e2e8f0;
    border-radius: 50px;
    font-weight: 600;
    color: #64748b;
    cursor: pointer;
    transition: all 0.3s;
}

.category-tab:hover,
.category-tab.active {
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    border-color: transparent;
}

.faq-list {
    max-width: 900px;
    margin: 0 auto;
}

.faq-item {
    background: #f8fafc;
    border-radius: 15px;
    margin-bottom: 1rem;
    overflow: hidden;
}

.faq-question {
    width: 100%;
    padding: 1.5rem 2rem;
    background: none;
    border: none;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    font-size: 1.1rem;
    font-weight: 600;
    color: #0f172a;
    text-align: left;
    transition: all 0.3s;
}

.faq-question:hover {
    background: #e2e8f0;
}

.faq-question.active {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.faq-answer {
    padding: 0 2rem 1.5rem 2rem;
    color: #64748b;
    line-height: 1.8;
}

.faq-answer p {
    font-size: 1rem;
}

/* FAQ Expand Animation */
.faq-expand-enter-active,
.faq-expand-leave-active {
    transition: all 0.3s ease;
}

.faq-expand-enter-from,
.faq-expand-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}

/* Support CTA */
.support-cta {
    padding: 5rem 2rem;
    background: #f8fafc;
}

.cta-card {
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    padding: 4rem;
    border-radius: 30px;
    text-align: center;
}

.cta-card h2 {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
}

.cta-card p {
    font-size: 1.2rem;
    opacity: 0.95;
    margin-bottom: 2.5rem;
}

.cta-buttons {
    display: flex;
    gap: 1.5rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-primary,
.btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1.2rem 2.5rem;
    border: none;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s;
    text-decoration: none;
}

.btn-primary {
    background: white;
    color: #1a0b5e;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
}

.btn-secondary {
    background: transparent;
    color: white;
    border: 2px solid white;
}

.btn-secondary:hover {
    background: white;
    color: #1a0b5e;
}

/* Transitions */
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

/* Responsive */
@media (max-width: 768px) {
    .main-content {
        padding-top: 118px;
    }

    .hero {
        padding: 3rem 1.5rem;
    }

    .quick-links-grid {
        grid-template-columns: 1fr;
    }

    .category-tabs {
        flex-direction: column;
        align-items: stretch;
    }

    .category-tab {
        text-align: center;
    }

    .cta-card {
        padding: 3rem 2rem;
    }

    .cta-buttons {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-primary,
    .btn-secondary {
        justify-content: center;
    }
}
</style>