import Authenticated from "@/Layouts/Authenticated/Index.jsx";
import SubscriptionCard from "@/Components/SubscriptionCard.jsx";
import { Head } from "@inertiajs/react";

export default function SubscriptionPlan({ auth, subscriptionPlans }) {
    return (
        <>
            <Head title="Subscription Plans" />
            <Authenticated auth={auth}>
                <div className="py-20 flex flex-col items-center">
                    <div className="text-black font-semibold text-[26px] mb-3">
                        Pricing for Everyone
                    </div>
                    <p className="text-base text-gray-1 leading-7 max-w-[302px] text-center">
                        Invest your little money to get a whole new experiences from
                        movies.
                    </p>

                    {/* Pricing Card */}
                    <div className="flex justify-center gap-10 mt-[70px]">
                        {/* Basic */}
                        {subscriptionPlans.map((subscriptionPlan) => (
                            <SubscriptionCard
                                name={subscriptionPlan.name}
                                price={subscriptionPlan.price}
                                durationInMonth={subscriptionPlan.durationInMonth}
                                features={JSON.parse(subscriptionPlan.features)}
                                isPremium={subscriptionPlan.name === 'Premium'}
                                key={subscriptionPlan.id}
                            />
                        ))}

                       
                    </div>
                </div>
            </Authenticated>
        </>
    );
}
