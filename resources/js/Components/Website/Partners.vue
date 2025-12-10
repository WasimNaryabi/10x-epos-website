<template>
    <section class="partners-section">
        <div class="partners-container">
            <!-- Section Header -->
            <div class="section-header" data-aos="fade-up">
                <span class="section-badge">Integrations</span>
                <h2 class="section-title">Seamlessly Integrates with Your Favorite Tools</h2>
                <p class="section-subtitle">
                    Connect with the platforms you already use to create a unified ecosystem
                </p>
            </div>

            <!-- Partners Logo Grid -->
            <div class="partners-grid" data-aos="fade-up">
                <div 
                    v-for="(partner, index) in partners" 
                    :key="index"
                    class="partner-card"
                    :data-aos="index % 2 === 0 ? 'fade-right' : 'fade-left'"
                    :data-aos-delay="index * 50"
                >
                    <div class="partner-logo">
                        <div class="partner-icon-wrapper" :style="{ background: `linear-gradient(135deg, ${partner.color}, ${partner.color}dd)` }">
                            <Icon :name="partner.icon" :size="32" color="white" />
                        </div>
                    </div>
                    <h3 class="partner-name">{{ partner.name }}</h3>
                    <p class="partner-category">{{ partner.category }}</p>
                </div>
            </div>

            <!-- Integration Categories -->
            <div class="categories-section" data-aos="fade-up">
                <h3>Integration Categories</h3>
                <div class="categories-grid">
                    <div 
                        v-for="(category, index) in categories" 
                        :key="index"
                        class="category-card"
                    >
                        <div class="category-icon" :style="{ background: category.gradient }">
                            <Icon :name="category.icon" :size="28" color="white" />
                        </div>
                        <h4>{{ category.title }}</h4>
                        <p>{{ category.description }}</p>
                        <div class="category-count">{{ category.count }}+ integrations</div>
                    </div>
                </div>
            </div>

    

            <!-- CTA -->
            <div class="integration-cta" data-aos="fade-up">
                <h3>Don't See Your Tool?</h3>
                <p>We're constantly adding new integrations. Let us know what you need!</p>
                <button @click="$emit('contact-sales')" class="cta-button">
                    <Icon name="email" :size="20" color="currentColor" />
                    Request Integration
                </button>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';
import Icon from '@/Components/Shared/Icon.vue';

defineEmits(['contact-sales']);

const partners = ref([
    { name: 'Stripe', icon: 'stripe', color: '#635BFF', category: 'Payments' },
    { name: 'PayPal', icon: 'paypal', color: '#00457C', category: 'Payments' },
    { name: 'Sumup', icon: 'square', color: '#000000', category: 'Payments' },
    { name: 'Uber Eats', icon: 'uber-eats', color: '#000000', category: 'Delivery' },
    { name: 'Deliveroo', icon: 'deliveroo', color: '#00CCBC', category: 'Delivery' },
    { name: 'Just Eat', icon: 'just-eat', color: '#F36D00', category: 'Delivery' }
]);

const categories = ref([
    {
        title: 'Payment Processing',
        icon: 'credit-card',
        gradient: 'linear-gradient(135deg, #667eea, #764ba2)',
        description: 'Accept payments from all major providers',
        count: 12
    },
    {
        title: 'Accounting Software',
        icon: 'chart-line',
        gradient: 'linear-gradient(135deg, #f093fb, #f5576c)',
        description: 'Sync financial data automatically',
        count: 8
    },
    {
        title: 'Delivery Platforms',
        icon: 'mobile',
        gradient: 'linear-gradient(135deg, #4facfe, #00f2fe)',
        description: 'Integrate with food delivery services',
        count: 15
    },
    {
        title: 'Marketing Tools',
        icon: 'email',
        gradient: 'linear-gradient(135deg, #43e97b, #38f9d7)',
        description: 'Connect with email and SMS platforms',
        count: 10
    }
]);
</script>

<style scoped>
.partners-section {
    padding: 6rem 2rem;
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
}

.partners-container {
    max-width: 1400px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-badge {
    display: inline-block;
    padding: 0.5rem 1.5rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 1rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 1rem;
}

.section-subtitle {
    font-size: 1.125rem;
    color: #64748b;
    max-width: 700px;
    margin: 0 auto;
}

.partners-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.partner-card {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s, box-shadow 0.3s;
    border: 1px solid #e2e8f0;
}

.partner-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
}

.partner-logo {
    margin-bottom: 1rem;
    display: flex;
    justify-content: center;
}

.partner-icon-wrapper {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    height: 70px;
    border-radius: 16px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.partner-card:hover .partner-icon-wrapper {
    transform: scale(1.1);
}

.partner-name {
    font-size: 1.125rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.5rem;
}

.partner-category {
    font-size: 0.875rem;
    color: #64748b;
}

.categories-section {
    margin: 4rem 0;
}

.categories-section h3 {
    font-size: 2rem;
    font-weight: 800;
    text-align: center;
    margin-bottom: 2rem;
    color: #0f172a;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.category-card {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    text-align: center;
}

.category-icon {
    width: 70px;
    height: 70px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 1.75rem;
}

.category-card h4 {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.75rem;
}

.category-card p {
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.category-count {
    color: #667eea;
    font-weight: 600;
    font-size: 0.9rem;
}

.api-section {
    margin: 4rem 0;
    background: white;
    border-radius: 20px;
    padding: 3rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.api-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: center;
}

.api-text h3 {
    font-size: 2rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 1rem;
}

.api-text p {
    color: #64748b;
    line-height: 1.8;
    margin-bottom: 1.5rem;
}

.api-features {
    list-style: none;
    padding: 0;
    margin: 0 0 2rem 0;
}

.api-features li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 0;
    color: #334155;
}

.api-button {
    padding: 1rem 2rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: transform 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
}

.api-button:hover {
    transform: translateY(-2px);
}

.code-window {
    background: #1e293b;
    border-radius: 10px;
    overflow: hidden;
}

.code-header {
    background: #334155;
    padding: 0.75rem 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.dot.red { background: #ff5f56; }
.dot.yellow { background: #ffbd2e; }
.dot.green { background: #27c93f; }

.code-title {
    color: #94a3b8;
    font-size: 0.875rem;
    margin-left: auto;
}

.code-content {
    padding: 1.5rem;
    font-family: 'Courier New', monospace;
    font-size: 0.875rem;
    color: #e2e8f0;
    overflow-x: auto;
}

.integration-cta {
    text-align: center;
    padding: 3rem;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border-radius: 20px;
    color: white;
    margin-top: 4rem;
}

.integration-cta h3 {
    font-size: 2rem;
    font-weight: 800;
    margin-bottom: 0.75rem;
}

.integration-cta p {
    font-size: 1.125rem;
    margin-bottom: 2rem;
}

.cta-button {
    padding: 1rem 2.5rem;
    background: white;
    color: #667eea;
    border: none;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: transform 0.3s;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
}

.cta-button:hover {
    transform: translateY(-2px);
}

@media (max-width: 1024px) {
    .api-content {
        grid-template-columns: 1fr;
    }

    .api-code {
        order: -1;
    }
}

@media (max-width: 768px) {
    .partners-section {
        padding: 4rem 1rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .partners-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .api-section {
        padding: 2rem 1rem;
    }
}
</style>