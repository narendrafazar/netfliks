// export default function PrimaryButton({
//     className = '',
//     disabled,
//     children,
//     ...props
// }) {
//     return (
//         <button
//             {...props}
//             className={
//                 `inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-gray-900 ${
//                     disabled && 'opacity-25'
//                 } ` + className
//             }
//             disabled={disabled}
//         >
//             {children}
//         </button>
//     );
// }

// sintaks atas sintaks default laravel 12

import React from "react";
import propTypes from "prop-types";
import { Button } from "@headlessui/react";

PrimaryButton.propTypes = {
    type: propTypes.oneOf(["button", "submit", "reset"]),
    // type: propTypes.string, // bisa juga pake string untuk tipe button
    className: propTypes.string,
    disabled: propTypes.bool,
    children: propTypes.node.isRequired,
    processing: propTypes.bool,
    variant: propTypes.oneOf([
        "primary",
        "warning",
        "danger",
        "light-outline",
        "white-outline",
    ]),
    processing: propTypes.bool,
};

export default function PrimaryButton({
    type = "submit",
    className = "",
    disabled,
    children,
    processing,
    variant = "primary",
    ...props
}) {
    return (
        <button
            {...props}
            className={`rounded-2xl py-[13px] text-center text-base font-semibold w-full ${
                processing && "opacity-30"
            } btn-${variant} ${className}`}
            disabled={processing}
        >
            {children}
        </button>
    );
}
