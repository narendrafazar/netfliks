// import { Link } from "@inertiajs/react";

// export default function MenuItem({
//     link,
//     icon,
//     text,
//     isActive,
//     method = "get",
// }) {
//     return (
//         <Link
//             href={link ? route(link) : null}
//             className={`side-link ${isActive && "active"}`}
//             method={method}
//             as="button"
//         >
//             {icon}
//             <span className="text-sm">{text}</span>
//         </Link>
//     );
// }

import { Link } from "@inertiajs/react";

export default function MenuItem({
    link,
    icon,
    text,
    isActive,
    method = "get",
}) {
    // Case 1: No link provided
    if (!link) {
        return (
            <div className="side-link cursor-default">
                {icon}
                <span className="text-sm">{text}</span>
            </div>
        );
    }

    // Case 2: Logout or POST/DELETE actions
    if (method.toLowerCase() !== "get") {
        return (
            <Link
                href={route(link)}
                method={method}
                as="button"
                className={`side-link ${isActive ? "active" : ""}`}
            >
                {icon}
                <span className="text-sm">{text}</span>
            </Link>
        );
    }

    // Case 3: Normal GET navigation
    return (
        <Link
            href={route(link)}
            className={`side-link ${isActive ? "active" : ""}`}
        >
            {icon}
            <span className="text-sm">{text}</span>
        </Link>
    );
}
