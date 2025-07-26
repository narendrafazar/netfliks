import { forwardRef, useEffect, useImperativeHandle, useRef } from 'react';
import PropTypes from "prop-types";
import { Input } from "postcss";

// kalo di react, kita bisa pake forwardRef untuk pass ref ke komponen
// jadi kita bisa fokus ke inputnya dari parent component
// ini juga bisa dipake untuk custom input component yang bisa diakses dari parent
// misalnya untuk fokus otomatis pada input saat komponen di-render
// atau untuk mengakses nilai input dari parent component

// kalo di react langsung, juga bisa langsung:
// import 'input.css';
// namun di inertia tidak bisa pake cara itu, harus gabungin dengan file CSS utama (app.css)

Input.propTypes = {
    type: PropTypes.oneOf(["text", "email", "password", "number", "file"]),
    className: PropTypes.string,
    isFocused: PropTypes.bool,
    name: PropTypes.string,
    autoComplete: PropTypes.string,
    required: PropTypes.bool,
    value: PropTypes.oneOfType([PropTypes.string, PropTypes.number]),
    variant: PropTypes.oneOf(["primary", "error", "primary-outline"]),
    defaultValue: PropTypes.oneOfType([PropTypes.string, PropTypes.number]),
    handleChange: PropTypes.func,
    placeholder: PropTypes.string,
    isError: PropTypes.bool,
};

export default forwardRef(function TextInput(
    { 
        type = "text",
        className = "",
        isFocused = false,
        value,
        defaultValue,
        variant = "primary",
        name,
        autoComplete,
        required,
        placeholder,
        handleChange,
        isError,
        ...props 
    },
    ref,
) {
    const localRef = useRef(null);

    useImperativeHandle(ref, () => ({
        focus: () => localRef.current?.focus(),
    }));

    useEffect(() => {
        if (isFocused) {
            localRef.current?.focus();
        }
    }, [isFocused]);

    return (
        <input
            {...props}
            type={type}
            className={
                `rounded-2xl bg-form-bg py-[13px] px-7 w-full ${isError && "input-error"} input-${variant} ${className}` 
                // ` ${isError ? 'border border-red-500' : ''} ` +
                // ` ${variant === 'primary' ? 'border border-gray-300' : ''} ` +
                // ` ${variant === 'primary-outline' ? 'border border-gray-300' : ''} ` +
                // ` ${className}`
            }
            ref={localRef}
            name={name}
            autoComplete={autoComplete}
            required={required}
            value={value}
            defaultValue={defaultValue}
            placeholder={placeholder}
            onChange={(e) => handleChange(e)}
        />
    );
});
