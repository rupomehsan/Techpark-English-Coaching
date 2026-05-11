import PaymentGateway from './pages/PaymentGateway.vue';
import EmailConfiguration from './pages/EmailConfiguration.vue';

const ConfigurationRoutes = [
    {
        path: 'configuration/payment-gateway',
        name: 'ConfigPaymentGateway',
        component: PaymentGateway,
    },
    {
        path: 'configuration/email',
        name: 'ConfigEmail',
        component: EmailConfiguration,
    },
];

export default ConfigurationRoutes;
