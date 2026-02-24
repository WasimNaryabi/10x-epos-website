<template>
    <div class="app-wrapper">
        <!-- Navbar -->
        <Navbar @request-demo="openDemoModal" />

        <!-- Main Content -->
        <main class="main-content">
            <!-- Hero Section -->
            <section class="hero">
                <div class="container">
                    <h1 class="hero-title" data-aos="fade-up">Contact Support</h1>
                    <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
                        We're here to help 24/7. Get in touch with our support team
                    </p>
                </div>
            </section>

            <!-- Contact Methods -->
            <section class="section contact-methods">
                <div class="container">
                    <div class="contact-grid">
                        <div 
                            v-for="(method, index) in contactMethods" 
                            :key="index"
                            class="contact-card"
                            data-aos="fade-up"
                            :data-aos-delay="index * 100"
                        >
                            <div class="contact-icon">
                                <Icon :name="method.icon" :size="36" color="white" />
                            </div>
                            <h3>{{ method.title }}</h3>
                            <p>{{ method.description }}</p>
                            <a :href="method.link" class="contact-link">{{ method.linkText }}</a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Support Form -->
            <section class="section support-form-section">
                <div class="container">
                    <div class="form-header" data-aos="fade-up">
                        <h2>Submit a Support Ticket</h2>
                        <p>Fill out the form below and we'll get back to you within 24 hours</p>
                    </div>

                    <form @submit.prevent="handleSubmit" class="support-form" data-aos="fade-up">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Full Name *</label>
                                <input type="text" id="name" v-model="form.name" required />
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" v-model="form.email" required />
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" id="phone" v-model="form.phone" />
                            </div>
                            <div class="form-group">
                                <label for="priority">Priority *</label>
                                <select id="priority" v-model="form.priority" required>
                                    <option value="">Select Priority</option>
                                    <option value="low">Low</option>
                                    <option value="medium">Medium</option>
                                    <option value="high">High</option>
                                    <option value="urgent">Urgent</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <input type="text" id="subject" v-model="form.subject" required />
                        </div>

                        <div class="form-group">
                            <label for="category">Category *</label>
                            <select id="category" v-model="form.category" required>
                                <option value="">Select Category</option>
                                <option value="technical">Technical Issue</option>
                                <option value="billing">Billing Question</option>
                                <option value="feature">Feature Request</option>
                                <option value="training">Training & Setup</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea 
                                id="message" 
                                v-model="form.message" 
                                rows="6" 
                                required
                                placeholder="Please describe your issue in detail..."
                            ></textarea>
                        </div>

                        <div class="form-group">
                            <label for="attachment">Attach File (optional)</label>
                            <input type="file" id="attachment" @change="handleFileUpload" />
                            <p class="file-hint">Max file size: 10MB. Accepted formats: PDF, PNG, JPG, DOC</p>
                        </div>

                        <button type="submit" class="submit-btn">
                            Submit Ticket
                            <Icon name="arrow-right" :size="20" color="white" />
                        </button>
                    </form>
                </div>
            </section>

            <!-- Response Time -->
            <section class="section response-time">
                <div class="container">
                    <div class="response-card" data-aos="zoom-in">
                        <h3>Our Response Times</h3>
                        <div class="response-grid">
                            <div class="response-item">
                                <div class="response-value">15 min</div>
                                <div class="response-label">Average Response</div>
                            </div>
                            <div class="response-item">
                                <div class="response-value">24/7</div>
                                <div class="response-label">Support Available</div>
                            </div>
                            <div class="response-item">
                                <div class="response-value">99%</div>
                                <div class="response-label">Customer Satisfaction</div>
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
import { ref, onMounted } from 'vue';
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

const form = ref({
    name: '',
    email: '',
    phone: '',
    priority: '',
    subject: '',
    category: '',
    message: '',
    attachment: null
});

const contactMethods = ref([
    {
        icon: 'phone',
        title: 'Phone Support',
        description: 'Speak directly with our support team',
        link: 'tel:+442012345678',
        linkText: '+44 20 1234 5678'
    },
    {
        icon: 'email',
        title: 'Email Support',
        description: 'Send us an email and we\'ll respond within 24 hours',
        link: 'mailto:support@10xglobalepos.com',
        linkText: 'support@10xglobalepos.com'
    },
    {
        icon: 'chat',
        title: 'Live Chat',
        description: 'Chat with us in real-time',
        link: '#',
        linkText: 'Start Live Chat'
    },
    {
        icon: 'headset',
        title: 'WhatsApp',
        description: 'Message us on WhatsApp for quick support',
        link: 'https://wa.me/442012345678',
        linkText: 'Chat on WhatsApp'
    }
]);

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

const handleSubmit = () => {
    // Submit form logic here
    successMessage.value = 'Support ticket submitted successfully! We\'ll get back to you within 24 hours.';
    showSuccessToast.value = true;
    
    // Reset form
    form.value = {
        name: '',
        email: '',
        phone: '',
        priority: '',
        subject: '',
        category: '',
        message: '',
        attachment: null
    };
    
    setTimeout(() => {
        showSuccessToast.value = false;
    }, 5000);
};

const handleFileUpload = (event) => {
    form.value.attachment = event.target.files[0];
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
}

/* Contact Methods */
.contact-methods {
    padding: 5rem 2rem;
    background: #f8fafc;
}

.contact-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.contact-card {
    background: white;
    padding: 2.5rem;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.06);
    transition: all 0.3s;
}

.contact-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(26, 11, 94, 0.15);
}

.contact-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
}

.contact-card h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.75rem;
}

.contact-card p {
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.contact-link {
    color: #1a0b5e;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s;
}

.contact-link:hover {
    color: #5842c3;
}

/* Support Form */
.support-form-section {
    padding: 5rem 2rem;
    background: white;
}

.form-header {
    text-align: center;
    margin-bottom: 3rem;
}

.form-header h2 {
    font-size: 2.5rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 1rem;
}

.form-header p {
    font-size: 1.1rem;
    color: #64748b;
}

.support-form {
    max-width: 800px;
    margin: 0 auto;
    background: #f8fafc;
    padding: 3rem;
    border-radius: 25px;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 0.75rem;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 1rem;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-family: inherit;
    font-size: 1rem;
    transition: border-color 0.3s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: #5842c3;
}

.form-group textarea {
    resize: vertical;
}

.file-hint {
    font-size: 0.875rem;
    color: #64748b;
    margin-top: 0.5rem;
}

.submit-btn {
    width: 100%;
    padding: 1.2rem;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(88, 66, 195, 0.4);
}

/* Response Time */
.response-time {
    padding: 5rem 2rem;
    background: #f8fafc;
}

.response-card {
    background: white;
    padding: 3rem;
    border-radius: 25px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
}

.response-card h3 {
    text-align: center;
    font-size: 2rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 2.5rem;
}

.response-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 2rem;
    text-align: center;
}

.response-value {
    font-size: 2.5rem;
    font-weight: 800;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.response-label {
    color: #64748b;
    font-weight: 500;
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

    .contact-grid {
        grid-template-columns: 1fr;
    }

    .support-form {
        padding: 2rem;
    }

    .form-row {
        grid-template-columns: 1fr;
    }

    .response-grid {
        grid-template-columns: 1fr;
    }
}
</style>