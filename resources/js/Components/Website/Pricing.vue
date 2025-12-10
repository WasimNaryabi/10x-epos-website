<template>
    <section id="pricing" class="pricing-section">
        <div class="pricing-container">
            <!-- Section Header -->
            <div class="section-header" data-aos="fade-up">
                <span class="section-badge">Pricing</span>
                <h2 class="section-title">Simple, Transparent Pricing</h2>
                <p class="section-subtitle">
                    Choose the perfect plan for your business. No hidden fees, no surprises.
                </p>
            </div>

            <!-- Billing Toggle -->
            <div class="billing-toggle" data-aos="fade-up">
                <span :class="{ active: billingCycle === 'monthly' }">Monthly</span>
                <button 
                    class="toggle-button"
                    @click="toggleBilling"
                    :class="{ yearly: billingCycle === 'yearly' }"
                >
                    <span class="toggle-slider"></span>
                </button>
                <span :class="{ active: billingCycle === 'yearly' }">
                    Yearly <span class="save-badge">Save 17%</span>
                </span>
            </div>

            <!-- Pricing Cards -->
            <div class="pricing-grid">
                <div 
                    v-for="(plan, index) in plans" 
                    :key="index"
                    class="pricing-card"
                    :class="{ popular: plan.popular }"
                    data-aos="fade-up"
                    :data-aos-delay="index * 100"
                >
                    <div v-if="plan.popular" class="popular-badge">
                        <Icon name="star" :size="16" color="white" />
                        Most Popular
                    </div>

                    <div class="plan-header">
                        <h3 class="plan-name">{{ plan.name }}</h3>
                        <p class="plan-description">{{ plan.description }}</p>
                    </div>

                    <div class="plan-price">
                        <span class="currency">£</span>
                        <span class="amount">{{ getPlanPrice(plan) }}</span>
                        <span class="period">/{{ billingCycle === 'monthly' ? 'month' : 'year' }}</span>
                    </div>

                    <div v-if="billingCycle === 'yearly'" class="yearly-savings">
                        Save £{{ calculateSavings(plan) }} per year
                    </div>

                    <button 
                        @click="$emit('request-demo')" 
                        class="plan-button"
                        :class="{ primary: plan.popular }"
                    >
                        <Icon name="rocket" :size="20" color="currentColor" />
                        Get Started
                    </button>

                    <div class="plan-features">
                        <h4>What's included:</h4>
                        <ul>
                            <li v-for="(feature, i) in plan.features" :key="i">
                                <Icon name="check" :size="16" color="#10b981" />
                                <span>{{ feature }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Features Comparison -->
            <div class="comparison-section" data-aos="fade-up">
                <h3>Compare All Features</h3>
                <div class="comparison-table-wrapper">
                    <table class="comparison-table">
                        <thead>
                            <tr>
                                <th>Feature</th>
                                <th v-for="plan in plans" :key="plan.name">{{ plan.name }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(feature, index) in comparisonFeatures" :key="index">
                                <td class="feature-name">{{ feature.name }}</td>
                                <td v-for="plan in plans" :key="plan.name" class="feature-value">
                                    <span v-if="typeof feature[plan.name.toLowerCase()] === 'boolean'">
                                        <Icon v-if="feature[plan.name.toLowerCase()]" name="check" :size="20" color="#10b981" />
                                        <Icon v-else name="close" :size="20" color="#cbd5e1" />
                                    </span>
                                    <span v-else>{{ feature[plan.name.toLowerCase()] }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="faq-section" data-aos="fade-up">
                <h3>Frequently Asked Questions</h3>
                <div class="faq-grid">
                    <div v-for="(faq, index) in faqs" :key="index" class="faq-item">
                        <h4>{{ faq.question }}</h4>
                        <p>{{ faq.answer }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed } from 'vue';
import Icon from '@/Components/Shared/Icon.vue';

defineEmits(['request-demo']);

const billingCycle = ref('monthly');

const plans = ref([
    {
        name: 'Starter',
        description: 'Perfect for small cafes and startups',
        monthlyPrice: 49,
        yearlyPrice: 490,
        popular: false,
        features: [
            '1 Terminal',
            '5 Staff Accounts',
            'Basic Reporting',
            'Email Support',
            'Cloud Backup',
            'Inventory Management',
            'Table Management',
            'Payment Integration'
        ]
    },
    {
        name: 'Professional',
        description: 'For growing restaurants',
        monthlyPrice: 99,
        yearlyPrice: 990,
        popular: true,
        features: [
            '3 Terminals',
            'Unlimited Staff',
            'Advanced Reporting',
            'Priority Support',
            'Cloud Backup',
            'Inventory Management',
            'Table Management',
            'Payment Integration',
            'KOT System',
            'Multi-location Support',
            'API Access'
        ]
    },
    {
        name: 'Enterprise',
        description: 'For chains and large operations',
        monthlyPrice: 199,
        yearlyPrice: 1990,
        popular: false,
        features: [
            'Unlimited Terminals',
            'Unlimited Staff',
            'Advanced Analytics',
            '24/7 Priority Support',
            'Cloud Backup',
            'Inventory Management',
            'Table Management',
            'Payment Integration',
            'KOT System',
            'Multi-location Support',
            'API Access',
            'Custom Integration',
            'Dedicated Account Manager',
            'On-site Training'
        ]
    }
]);

const comparisonFeatures = ref([
    { name: 'Terminals', starter: '1', professional: '3', enterprise: 'Unlimited' },
    { name: 'Staff Accounts', starter: '5', professional: 'Unlimited', enterprise: 'Unlimited' },
    { name: 'POS System', starter: true, professional: true, enterprise: true },
    { name: 'Inventory Management', starter: true, professional: true, enterprise: true },
    { name: 'Table Management', starter: true, professional: true, enterprise: true },
    { name: 'Payment Integration', starter: true, professional: true, enterprise: true },
    { name: 'Basic Reporting', starter: true, professional: true, enterprise: true },
    { name: 'Advanced Reporting', starter: false, professional: true, enterprise: true },
    { name: 'KOT System', starter: false, professional: true, enterprise: true },
    { name: 'Multi-location', starter: false, professional: true, enterprise: true },
    { name: 'API Access', starter: false, professional: true, enterprise: true },
    { name: 'Email Support', starter: true, professional: true, enterprise: true },
    { name: 'Priority Support', starter: false, professional: true, enterprise: true },
    { name: '24/7 Support', starter: false, professional: false, enterprise: true },
    { name: 'Custom Integration', starter: false, professional: false, enterprise: true },
    { name: 'Account Manager', starter: false, professional: false, enterprise: true },
    { name: 'On-site Training', starter: false, professional: false, enterprise: true }
]);

const faqs = ref([
    {
        question: 'Can I switch plans later?',
        answer: 'Yes! You can upgrade or downgrade your plan at any time. Changes take effect immediately and we\'ll prorate the difference.'
    },
    {
        question: 'Is there a free trial?',
        answer: 'Yes, we offer a 14-day free trial with full access to all features. No credit card required.'
    },
    {
        question: 'What payment methods do you accept?',
        answer: 'We accept all major credit cards, debit cards, and bank transfers for annual plans.'
    },
    {
        question: 'Is training included?',
        answer: 'All plans include online training resources. Enterprise plan includes dedicated on-site training.'
    }
]);

const toggleBilling = () => {
    billingCycle.value = billingCycle.value === 'monthly' ? 'yearly' : 'monthly';
};

const getPlanPrice = (plan) => {
    return billingCycle.value === 'monthly' ? plan.monthlyPrice : plan.yearlyPrice;
};

const calculateSavings = (plan) => {
    const monthlyTotal = plan.monthlyPrice * 12;
    const yearlySavings = monthlyTotal - plan.yearlyPrice;
    return yearlySavings;
};
</script>

<style scoped>
.pricing-section {
    padding: 6rem 2rem;
    background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);
}

.pricing-container {
    max-width: 1400px;
    margin: 0 auto;
}

.section-header {
    text-align: center;
    margin-bottom: 3rem;
}

.section-badge {
    display: inline-block;
    padding: 0.5rem 1.5rem;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
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
    max-width: 600px;
    margin: 0 auto;
}

.billing-toggle {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    margin-bottom: 3rem;
}

.billing-toggle span {
    font-weight: 600;
    color: #64748b;
    transition: color 0.3s;
}

.billing-toggle span.active {
    color: #667eea;
}

.save-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    background: #10b981;
    color: white;
    border-radius: 20px;
    font-size: 0.75rem;
    margin-left: 0.5rem;
}

.toggle-button {
    position: relative;
    width: 60px;
    height: 30px;
    background: #e2e8f0;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    transition: background 0.3s;
}

.toggle-button.yearly {
    background: #667eea;
}

.toggle-slider {
    position: absolute;
    top: 3px;
    left: 3px;
    width: 24px;
    height: 24px;
    background: white;
    border-radius: 50%;
    transition: transform 0.3s;
}

.toggle-button.yearly .toggle-slider {
    transform: translateX(30px);
}

.pricing-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.pricing-card {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 2px solid #e2e8f0;
    position: relative;
    transition: transform 0.3s, box-shadow 0.3s;
}

.pricing-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
}

.pricing-card.popular {
    border-color: #667eea;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.2);
}

.popular-badge {
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    padding: 0.5rem 1.5rem;
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.plan-header {
    margin-bottom: 2rem;
}

.plan-name {
    font-size: 1.75rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 0.5rem;
}

.plan-description {
    color: #64748b;
    font-size: 1rem;
}

.plan-price {
    display: flex;
    align-items: baseline;
    margin-bottom: 0.5rem;
}

.currency {
    font-size: 1.5rem;
    font-weight: 600;
    color: #667eea;
}

.amount {
    font-size: 3rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0.25rem;
}

.period {
    font-size: 1rem;
    color: #64748b;
}

.yearly-savings {
    color: #10b981;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}

.plan-button {
    width: 100%;
    padding: 1rem;
    background: #f8fafc;
    color: #667eea;
    border: 2px solid #667eea;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    margin-bottom: 2rem;
}

.plan-button:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
}

.plan-button.primary {
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
    border: none;
}

.plan-features h4 {
    font-size: 1rem;
    font-weight: 600;
    color: #0f172a;
    margin-bottom: 1rem;
}

.plan-features ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.plan-features li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.5rem 0;
    color: #334155;
    font-size: 0.95rem;
}

.plan-features li i {
    color: #10b981;
    font-size: 0.875rem;
}

.comparison-section {
    margin: 4rem 0;
}

.comparison-section h3 {
    font-size: 2rem;
    font-weight: 800;
    text-align: center;
    margin-bottom: 2rem;
    color: #0f172a;
}

.comparison-table-wrapper {
    overflow-x: auto;
}

.comparison-table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.comparison-table thead {
    background: linear-gradient(135deg, #1a0b5e, #5842c3);
    color: white;
}

.comparison-table th {
    padding: 1.5rem 1rem;
    text-align: left;
    font-weight: 600;
}

.comparison-table td {
    padding: 1rem;
    border-bottom: 1px solid #e2e8f0;
}

.comparison-table tbody tr:last-child td {
    border-bottom: none;
}

.comparison-table tbody tr:hover {
    background: #f8fafc;
}

.feature-name {
    font-weight: 600;
    color: #0f172a;
}

.feature-value {
    text-align: center;
    color: #64748b;
}

.faq-section {
    margin-top: 4rem;
}

.faq-section h3 {
    font-size: 2rem;
    font-weight: 800;
    text-align: center;
    margin-bottom: 2rem;
    color: #0f172a;
}

.faq-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.faq-item {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.faq-item h4 {
    font-size: 1.125rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 0.75rem;
}

.faq-item p {
    color: #64748b;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .pricing-section {
        padding: 4rem 1rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .pricing-grid {
        grid-template-columns: 1fr;
    }

    .comparison-table {
        font-size: 0.9rem;
    }

    .comparison-table th,
    .comparison-table td {
        padding: 0.75rem 0.5rem;
    }
}
</style>