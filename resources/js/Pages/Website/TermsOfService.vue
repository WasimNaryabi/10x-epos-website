<template>
    <div class="app-wrapper">
        <!-- Navbar -->
        <Navbar @request-demo="openDemoModal" />

        <!-- Main Content -->
        <main class="main-content">
            <!-- Hero Section -->
            <section class="hero">
                <div class="container">
                    <h1 class="hero-title" data-aos="fade-up">Terms of Service</h1>
                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
                        Last updated: {{ lastUpdated }}
                    </p>
                </div>
            </section>

            <!-- Terms Content -->
            <section class="section terms-content">
                <div class="container">
                    <div class="terms-sidebar" data-aos="fade-right">
                        <div class="sidebar-sticky">
                            <h3>Contents</h3>
                            <ul class="toc-list">
                                <li 
                                    v-for="section in sections" 
                                    :key="section.id"
                                    :class="{ active: activeSection === section.id }"
                                >
                                    <a @click.prevent="scrollToSection(section.id)">
                                        {{ section.title }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="terms-main" data-aos="fade-left">
                        <!-- Acceptance of Terms -->
                        <div :id="'section-' + sections[0].id" class="terms-section">
                            <h2>{{ sections[0].title }}</h2>
                            <p>Welcome to 10x Global . By accessing or using our point of sale system and related services ("Services"), you agree to be bound by these Terms of Service ("Terms").</p>
                            <p>Please read these Terms carefully before using our Services. If you do not agree to these Terms, you may not use our Services.</p>
                        </div>

                        <!-- Definitions -->
                        <div :id="'section-' + sections[1].id" class="terms-section">
                            <h2>{{ sections[1].title }}</h2>
                            <ul>
                                <li><strong>"Company"</strong> refers to 10x Global, located at 123 Business Street, Tech City, London, EC1A 1BB, UK</li>
                                <li><strong>"Services"</strong> refers to the EPOS software, hardware, cloud services, and support provided by the Company</li>
                                <li><strong>"User"</strong> or "You" refers to the individual or business entity using our Services</li>
                                <li><strong>"Account"</strong> refers to your registered account with the Company</li>
                                <li><strong>"Content"</strong> refers to all data, text, software, graphics, and other materials accessed through the Services</li>
                            </ul>
                        </div>

                        <!-- Account Registration -->
                        <div :id="'section-' + sections[2].id" class="terms-section">
                            <h2>{{ sections[2].title }}</h2>
                            <p>To use our Services, you must:</p>
                            <ul>
                                <li>Be at least 18 years old or the age of majority in your jurisdiction</li>
                                <li>Provide accurate, current, and complete information during registration</li>
                                <li>Maintain the security of your account credentials</li>
                                <li>Notify us immediately of any unauthorized access to your account</li>
                                <li>Be responsible for all activities that occur under your account</li>
                            </ul>
                            <p>We reserve the right to refuse service, terminate accounts, or cancel orders at our sole discretion.</p>
                        </div>

                        <!-- License and Usage -->
                        <div :id="'section-' + sections[3].id" class="terms-section">
                            <h2>{{ sections[3].title }}</h2>
                            <p>Subject to these Terms, we grant you a limited, non-exclusive, non-transferable license to:</p>
                            <ul>
                                <li>Access and use the Services for your business operations</li>
                                <li>Install the software on authorized devices</li>
                                <li>Access cloud-based features and data storage</li>
                            </ul>
                            <p><strong>You agree NOT to:</strong></p>
                            <ul>
                                <li>Reverse engineer, decompile, or disassemble the software</li>
                                <li>Rent, lease, lend, sell, or sublicense the Services</li>
                                <li>Remove or alter any proprietary notices</li>
                                <li>Use the Services for any illegal or unauthorized purpose</li>
                                <li>Interfere with or disrupt the Services or servers</li>
                                <li>Attempt to gain unauthorized access to any systems or networks</li>
                            </ul>
                        </div>

                        <!-- Payment Terms -->
                        <div :id="'section-' + sections[4].id" class="terms-section">
                            <h2>{{ sections[4].title }}</h2>
                            
                            <h3>Subscription Fees</h3>
                            <p>You agree to pay all fees associated with your subscription plan. Fees are billed in advance on a monthly or annual basis depending on your selected plan.</p>
                            
                            <h3>Payment Methods</h3>
                            <p>We accept major credit cards, debit cards, and bank transfers. You authorize us to charge your payment method for all fees incurred.</p>
                            
                            <h3>Late Payments</h3>
                            <p>If payment is not received within 7 days of the due date, we may suspend or terminate your access to the Services.</p>
                            
                            <h3>Refunds</h3>
                            <p>We offer a 30-day money-back guarantee for new customers. After 30 days, fees are non-refundable except as required by law.</p>
                            
                            <h3>Price Changes</h3>
                            <p>We reserve the right to change our pricing with 30 days' notice. Price changes will not affect your current billing cycle.</p>
                        </div>

                        <!-- Data and Privacy -->
                        <div :id="'section-' + sections[5].id" class="terms-section">
                            <h2>{{ sections[5].title }}</h2>
                            <p>Your use of the Services is also governed by our Privacy Policy. By using our Services, you consent to:</p>
                            <ul>
                                <li>Collection and processing of your data as described in our Privacy Policy</li>
                                <li>Storage of transaction data on our secure servers</li>
                                <li>Use of cookies and tracking technologies</li>
                                <li>Backup and redundancy procedures for data protection</li>
                            </ul>
                            <p>We implement industry-standard security measures, but you are responsible for maintaining the confidentiality of your data and account credentials.</p>
                        </div>

                        <!-- Service Availability -->
                        <div :id="'section-' + sections[6].id" class="terms-section">
                            <h2>{{ sections[6].title }}</h2>
                            <p>We strive to provide 99.9% uptime for our Services. However:</p>
                            <ul>
                                <li>Services may be temporarily unavailable due to maintenance, updates, or technical issues</li>
                                <li>We will provide advance notice of scheduled maintenance when possible</li>
                                <li>We are not liable for damages resulting from service interruptions</li>
                                <li>No SLA credits are provided for downtime unless specified in Enterprise agreements</li>
                            </ul>
                        </div>

                        <!-- Intellectual Property -->
                        <div :id="'section-' + sections[7].id" class="terms-section">
                            <h2>{{ sections[7].title }}</h2>
                            <p>All intellectual property rights in the Services, including software, design, graphics, and documentation, belong to 10x Global or our licensors.</p>
                            <p>Your business data remains your property. You grant us a license to use, store, and process your data solely for the purpose of providing the Services.</p>
                        </div>

                        <!-- Limitation of Liability -->
                        <div :id="'section-' + sections[8].id" class="terms-section">
                            <h2>{{ sections[8].title }}</h2>
                            <p>To the maximum extent permitted by law:</p>
                            <ul>
                                <li>The Services are provided "AS IS" without warranties of any kind</li>
                                <li>We are not liable for indirect, incidental, or consequential damages</li>
                                <li>Our total liability is limited to the fees you paid in the 12 months preceding the claim</li>
                                <li>We are not responsible for third-party services or integrations</li>
                                <li>You are responsible for backing up your data</li>
                            </ul>
                        </div>

                        <!-- Termination -->
                        <div :id="'section-' + sections[9].id" class="terms-section">
                            <h2>{{ sections[9].title }}</h2>
                            <p>You may terminate your account at any time by contacting support. Upon termination:</p>
                            <ul>
                                <li>Your access to the Services will cease</li>
                                <li>You remain responsible for any outstanding fees</li>
                                <li>You can export your data within 30 days of termination</li>
                                <li>We may delete your data after 30 days unless required to retain it by law</li>
                            </ul>
                            <p>We may terminate or suspend your access immediately if you breach these Terms.</p>
                        </div>

                        <!-- Changes to Terms -->
                        <div :id="'section-' + sections[10].id" class="terms-section">
                            <h2>{{ sections[10].title }}</h2>
                            <p>We may modify these Terms at any time. We will notify you of material changes via email or through the Services. Continued use of the Services after changes constitutes acceptance of the new Terms.</p>
                        </div>

                        <!-- Governing Law -->
                        <div :id="'section-' + sections[11].id" class="terms-section">
                            <h2>{{ sections[11].title }}</h2>
                            <p>These Terms are governed by the laws of England and Wales. Any disputes will be resolved in the courts of England and Wales.</p>
                        </div>

                        <!-- Contact Information -->
                        <div :id="'section-' + sections[12].id" class="terms-section">
                            <h2>{{ sections[12].title }}</h2>
                            <p>If you have questions about these Terms, please contact us:</p>
                            <div class="contact-info">
                                <p><strong>Email:</strong> info@10xglobale.co.uk</p>
                                <p><strong>Phone:</strong> 020 805 800 86</p>
                                <!-- <p><strong>Address:</strong> 123 Business Street, Tech City, London, EC1A 1BB, UK</p> -->
                            </div>
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
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Navbar from '@/Components/Shared/Navbar.vue';
import Footer from '@/Components/Shared/Footer.vue';
import DemoRequestModal from '@/Components/Website/DemoRequestModal.vue';
import AOS from 'aos';
import 'aos/dist/aos.css';

// State
const showDemoModal = ref(false);
const activeSection = ref('acceptance');
const lastUpdated = ref('February 24, 2026');

const sections = ref([
    { id: 'acceptance', title: 'Acceptance of Terms' },
    { id: 'definitions', title: 'Definitions' },
    { id: 'account', title: 'Account Registration' },
    { id: 'license', title: 'License and Usage' },
    { id: 'payment', title: 'Payment Terms' },
    { id: 'privacy', title: 'Data and Privacy' },
    { id: 'availability', title: 'Service Availability' },
    { id: 'intellectual', title: 'Intellectual Property' },
    { id: 'liability', title: 'Limitation of Liability' },
    { id: 'termination', title: 'Termination' },
    { id: 'changes', title: 'Changes to Terms' },
    { id: 'governing', title: 'Governing Law' },
    { id: 'contact', title: 'Contact Information' }
]);

// Methods
const openDemoModal = () => {
    showDemoModal.value = true;
};

const handleDemoSubmit = () => {
    showDemoModal.value = false;
};

const scrollToSection = (sectionId) => {
    const element = document.getElementById(`section-${sectionId}`);
    if (element) {
        const offset = 150;
        const elementPosition = element.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;

        window.scrollTo({
            top: offsetPosition,
            behavior: 'smooth'
        });
        
        activeSection.value = sectionId;
    }
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
/* Same styles as PrivacyPolicy.vue */
.app-wrapper {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
    background: white;
}

.main-content {
    flex: 1;
    padding-top: 128px;
}

.hero {
    padding: 4rem 2rem;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    text-align: center;
}

.container {
    max-width: 1400px;
    margin: 0 auto;
}

.hero-title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 800;
    margin-bottom: 1rem;
}

.hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
}

.terms-content {
    padding: 5rem 2rem;
}

.terms-content .container {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 4rem;
    align-items: start;
}

.terms-sidebar {
    position: relative;
}

.sidebar-sticky {
    position: sticky;
    top: 150px;
    background: #f8fafc;
    padding: 2rem;
    border-radius: 20px;
}

.sidebar-sticky h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 1.5rem;
}

.toc-list {
    list-style: none;
}

.toc-list li {
    margin-bottom: 0.75rem;
}

.toc-list a {
    color: #64748b;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
    cursor: pointer;
    display: block;
    padding: 0.5rem;
    border-radius: 8px;
}

.toc-list li:hover a,
.toc-list li.active a {
    color: #1a0b5e;
    background: white;
}

.terms-main {
    max-width: 900px;
}

.terms-section {
    margin-bottom: 4rem;
}

.terms-section h2 {
    font-size: 2rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 1.5rem;
}

.terms-section h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0f172a;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.terms-section p {
    color: #64748b;
    line-height: 1.8;
    margin-bottom: 1.5rem;
    font-size: 1.05rem;
}

.terms-section ul {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.terms-section li {
    color: #64748b;
    line-height: 1.8;
    margin-bottom: 0.75rem;
}

.terms-section li strong {
    color: #0f172a;
}

.contact-info {
    background: #f8fafc;
    padding: 2rem;
    border-radius: 15px;
    border-left: 4px solid #1a0b5e;
}

.contact-info p {
    margin-bottom: 1rem;
}

.contact-info p:last-child {
    margin-bottom: 0;
}

@media (max-width: 968px) {
    .main-content {
        padding-top: 118px;
    }

    .terms-content .container {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .sidebar-sticky {
        position: static;
    }

    .toc-list {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }

    .toc-list li {
        margin-bottom: 0;
    }

    .toc-list a {
        font-size: 0.9rem;
        white-space: nowrap;
    }

    .hero {
        padding: 3rem 1.5rem;
    }
}
</style>