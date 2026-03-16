<template>
    <div class="app-wrapper">
        <!-- Navbar -->
        <Navbar @request-demo="openDemoModal" />

        <!-- Main Content -->
        <main class="main-content">
            <!-- Hero Section -->
            <section class="hero">
                <div class="container">
                    <h1 class="hero-title" data-aos="fade-up">Privacy Policy</h1>
                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
                        Last updated: {{ lastUpdated }}
                    </p>
                </div>
            </section>

            <!-- Policy Content -->
            <section class="section policy-content">
                <div class="container">
                    <div class="policy-sidebar" data-aos="fade-right">
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

                    <div class="policy-main" data-aos="fade-left">
                        <!-- Introduction -->
                        <div :id="'section-' + sections[0].id" class="policy-section">
                            <h2>{{ sections[0].title }}</h2>
                            <p>10x Global ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our point of sale system and related services.</p>
                            <p>Please read this privacy policy carefully. If you do not agree with the terms of this privacy policy, please do not access the application or services.</p>
                        </div>

                        <!-- Information We Collect -->
                        <div :id="'section-' + sections[1].id" class="policy-section">
                            <h2>{{ sections[1].title }}</h2>
                            
                            <h3>Personal Data</h3>
                            <p>While using our services, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you. This may include:</p>
                            <ul>
                                <li>Email address</li>
                                <li>First name and last name</li>
                                <li>Phone number</li>
                                <li>Business name and address</li>
                                <li>Payment information (processed securely through third-party payment processors)</li>
                            </ul>

                            <h3>Usage Data</h3>
                            <p>We automatically collect certain information when you use our services:</p>
                            <ul>
                                <li>Transaction data and sales reports</li>
                                <li>Device information (IP address, browser type, operating system)</li>
                                <li>Usage patterns and feature preferences</li>
                                <li>Log files and diagnostic data</li>
                                <li>Location data (if you enable location services)</li>
                            </ul>

                            <h3>Cookies and Tracking Technologies</h3>
                            <p>We use cookies and similar tracking technologies to track activity on our service and store certain information. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.</p>
                        </div>

                        <!-- How We Use Your Information -->
                        <div :id="'section-' + sections[2].id" class="policy-section">
                            <h2>{{ sections[2].title }}</h2>
                            <p>We use the collected information for various purposes:</p>
                            <ul>
                                <li><strong>To provide and maintain our service:</strong> Including processing transactions, managing your account, and providing customer support</li>
                                <li><strong>To improve our services:</strong> Analyzing usage patterns to enhance features and user experience</li>
                                <li><strong>To communicate with you:</strong> Sending service updates, security alerts, and support messages</li>
                                <li><strong>To process payments:</strong> Facilitating transactions and maintaining financial records</li>
                                <li><strong>To comply with legal obligations:</strong> Meeting regulatory and compliance requirements</li>
                                <li><strong>To detect and prevent fraud:</strong> Monitoring for suspicious activity and protecting against security threats</li>
                            </ul>
                        </div>

                        <!-- Data Retention -->
                        <div :id="'section-' + sections[3].id" class="policy-section">
                            <h2>{{ sections[3].title }}</h2>
                            <p>We will retain your personal data only for as long as necessary for the purposes set out in this Privacy Policy. We will retain and use your data to the extent necessary to comply with our legal obligations, resolve disputes, and enforce our policies.</p>
                            <p>Transaction data is typically retained for 7 years to comply with accounting and tax regulations. Usage data is generally retained for a shorter period, except when used for security purposes or to improve our services.</p>
                        </div>

                        <!-- Data Security -->
                        <div :id="'section-' + sections[4].id" class="policy-section">
                            <h2>{{ sections[4].title }}</h2>
                            <p>The security of your data is important to us. We implement appropriate technical and organizational measures to protect your personal information:</p>
                            <ul>
                                <li>256-bit SSL encryption for data transmission</li>
                                <li>Encrypted data storage with AES-256 encryption</li>
                                <li>Regular security audits and penetration testing</li>
                                <li>PCI-DSS compliance for payment processing</li>
                                <li>Access controls and authentication protocols</li>
                                <li>Regular backups and disaster recovery procedures</li>
                            </ul>
                            <p>However, no method of transmission over the Internet or electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your data, we cannot guarantee absolute security.</p>
                        </div>

                        <!-- Data Sharing -->
                        <div :id="'section-' + sections[5].id" class="policy-section">
                            <h2>{{ sections[5].title }}</h2>
                            <p>We do not sell your personal data. We may share your information in the following circumstances:</p>
                            <ul>
                                <li><strong>Service Providers:</strong> With third-party companies that help us provide our services (payment processors, cloud hosting, analytics)</li>
                                <li><strong>Business Transfers:</strong> In connection with any merger, sale of company assets, financing, or acquisition</li>
                                <li><strong>Legal Requirements:</strong> When required by law or to respond to legal process</li>
                                <li><strong>With Your Consent:</strong> When you have given explicit consent to share specific information</li>
                            </ul>
                        </div>

                        <!-- Your Rights -->
                        <div :id="'section-' + sections[6].id" class="policy-section">
                            <h2>{{ sections[6].title }}</h2>
                            <p>You have certain rights regarding your personal data:</p>
                            <ul>
                                <li><strong>Access:</strong> Request copies of your personal data</li>
                                <li><strong>Rectification:</strong> Request correction of inaccurate or incomplete data</li>
                                <li><strong>Erasure:</strong> Request deletion of your personal data</li>
                                <li><strong>Restriction:</strong> Request restriction of processing your data</li>
                                <li><strong>Portability:</strong> Request transfer of your data to another service</li>
                                <li><strong>Objection:</strong> Object to processing of your personal data</li>
                                <li><strong>Withdraw Consent:</strong> Withdraw consent where we rely on consent to process your data</li>
                            </ul>
                            <p>To exercise these rights, please contact us at privacy@10xglobalepos.com</p>
                        </div>

                        <!-- Third-Party Links -->
                        <div :id="'section-' + sections[7].id" class="policy-section">
                            <h2>{{ sections[7].title }}</h2>
                            <p>Our service may contain links to third-party websites or services. We are not responsible for the privacy practices of these third parties. We encourage you to read their privacy policies before providing any information.</p>
                        </div>

                        <!-- Children's Privacy -->
                        <div :id="'section-' + sections[8].id" class="policy-section">
                            <h2>{{ sections[8].title }}</h2>
                            <p>Our services are not intended for individuals under the age of 18. We do not knowingly collect personal information from children. If you become aware that a child has provided us with personal data, please contact us immediately.</p>
                        </div>

                        <!-- Updates to Policy -->
                        <div :id="'section-' + sections[9].id" class="policy-section">
                            <h2>{{ sections[9].title }}</h2>
                            <p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date.</p>
                            <p>You are advised to review this Privacy Policy periodically for any changes. Changes become effective when posted on this page.</p>
                        </div>

                        <!-- Contact Us -->
                        <div :id="'section-' + sections[10].id" class="policy-section">
                            <h2>{{ sections[10].title }}</h2>
                            <p>If you have any questions about this Privacy Policy, please contact us:</p>
                            <div class="contact-info">
                                <p><strong>Email:</strong> info@10xglobal.co.uk</p>
                                <p><strong>Phone:</strong>020 805 800 86</p>
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
const activeSection = ref('introduction');
const lastUpdated = ref('February 24, 2026');

const sections = ref([
    { id: 'introduction', title: 'Introduction' },
    { id: 'information-collect', title: 'Information We Collect' },
    { id: 'how-use', title: 'How We Use Your Information' },
    { id: 'data-retention', title: 'Data Retention' },
    { id: 'data-security', title: 'Data Security' },
    { id: 'data-sharing', title: 'Data Sharing and Disclosure' },
    { id: 'your-rights', title: 'Your Rights' },
    { id: 'third-party', title: 'Third-Party Links' },
    { id: 'children', title: "Children's Privacy" },
    { id: 'updates', title: 'Updates to This Policy' },
    { id: 'contact', title: 'Contact Us' }
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
        const offset = 150; // Account for navbar
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
/* App Wrapper */
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

/* Hero Section */
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

/* Policy Content */
.policy-content {
    padding: 5rem 2rem;
}

.policy-content .container {
    display: grid;
    grid-template-columns: 300px 1fr;
    gap: 4rem;
    align-items: start;
}

/* Sidebar */
.policy-sidebar {
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

/* Policy Main Content */
.policy-main {
    max-width: 900px;
}

.policy-section {
    margin-bottom: 4rem;
}

.policy-section h2 {
    font-size: 2rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 1.5rem;
}

.policy-section h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0f172a;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.policy-section p {
    color: #64748b;
    line-height: 1.8;
    margin-bottom: 1.5rem;
    font-size: 1.05rem;
}

.policy-section ul {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.policy-section li {
    color: #64748b;
    line-height: 1.8;
    margin-bottom: 0.75rem;
}

.policy-section li strong {
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

/* Responsive */
@media (max-width: 968px) {
    .main-content {
        padding-top: 118px;
    }

    .policy-content .container {
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