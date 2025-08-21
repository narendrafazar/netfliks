import { useState, useRef } from "react";
import { Link } from "@inertiajs/react";

export default function Topbar({name}) {
    const [dropdownOpen, setDropdownOpen] = useState(true);
    const dropdownTarget = useRef();

    const toggleDropdown = () => {
        if (dropdownOpen) {
            dropdownTarget.current.classList.remove("hidden");
            dropdownTarget.current.classList.add("block");
            dropdownTarget.current.classList.add("flex");
        } else {
            dropdownTarget.current.classList.add("hidden");
            dropdownTarget.current.classList.remove("block");
        }
        setDropdownOpen(!dropdownOpen);
    };

    return (
        <div className="flex justify-between items-center">
            <input
                type="text"
                className="top-search flex items-center gap-2 bg-gray-2 rounded-full py-3 px-4 w-[400px] text-sm font-medium text-black placeholder:text-gray-4"
                placeholder="Search movie, cast, genre"
                // style diubah jadi inline style
                // karena tailwind tidak mendukung background-image
                style={{
                    backgroundImage: "url('/icons/ic_search.svg')",
                    backgroundSize: "16px",
                    backgroundPosition: "right 20px center",
                    backgroundRepeat: "no-repeat",
                }}
            />
            <div className="flex items-center gap-4">
                <span className="text-black text-sm font-medium">
                Welcome, {name}
                </span>

                <div className="collapsible-dropdown flex flex-col gap-2 relative cursor-pointer">
                    <div
                        className="outline outline-2 outline-gray-2 p-[5px] rounded-full w-[60px] dropdown-button"
                        onClick={toggleDropdown}
                    >
                        <img
                            src="/images/avatar.png"
                            className="rounded-full object-cover w-full"
                            alt=""
                        />
                    </div>
                    <div
                        // className="bg-white rounded-2xl text-black font-medium flex flex-col gap-1 absolute z-[999] right-0 top-[80px] min-w-[180px] hidden overflow-hidden"
                        className="bg-white rounded-2xl text-black font-medium flex-col gap-1 absolute z-[999] right-0 top-[80px] min-w-[180px] hidden overflow-hidden"
                        ref={dropdownTarget} // ✅ corrected
                    >
                        <a
                            href="#!"
                            className="transition-all hover:bg-sky-100 p-4 flex"
                        >
                            Dashboard
                        </a>
                        <a
                            href="#!"
                            className="transition-all hover:bg-sky-100 p-4 flex"
                            // ✅ added `as="button"` to make it a button
                            // ✅ added `method="post"` to ensure it submits as a POST request
                            // ✅ added `onClick` to handle confirmation before logout
                            // ✅ added `className` for styling 
                        >
                            Settings
                        </a>
                        <Link
                            href={route("logout")}
                            
                            method="post"
                            as="button"
                            onClick={(e) => {
                                if (!confirm("Are you sure you want to log out?")) {
                                    e.preventDefault();
                                }
                            }}
                            className="transition-all hover:bg-sky-100 p-4 flex"
                        >   
                            Sign Out
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    );
}
