"use client";

import * as React from 'react';
import * as z from 'zod';
import { zodResolver } from "@hookform/resolvers/zod";
import { Controller, useForm } from "react-hook-form";
import {FormEventHandler, useState} from 'react';
import { router } from "@inertiajs/react";

import { Button } from "@/components/ui/button";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/components/ui/card"
import {
    Field,
    FieldDescription,
    FieldError,
    FieldGroup,
    FieldLabel,
} from "@/components/ui/field"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Separator } from "@/components/ui/separator"

import GuestLayout from '@/layouts/GuestLayout';
import { Head, Link } from '@inertiajs/react';


export default function Login() {

    const [open, setOpen] = useState(false);

    const schema = z.object({
        email: z.string().email("Please enter a valid email address"),
        password: z.string().min(1, { message: "Password is required" }),
        remember: z.boolean().optional(),
    })


    type LoginFormData = z.infer<typeof schema>;

    // Set up the form with zod
    const form = useForm<z.infer<typeof schema>>({
        resolver: zodResolver(schema),
        defaultValues: {
            email: "",
            password: "",
        }
    })


    function onSubmit(data: z.infer<typeof schema>) {
        console.log(data);

        router.post(route('login'), data)
    }

    return (
       <>
           <div className="flex min-h-screen items-center justify-center p-4 bg-gray-100">
               <Card className="w-full flex sm:max-w-md py-6 px-2 bg-white border-0 shadow-none outline-none shadow-xl">
                   <CardHeader className="mb-3">
                       <CardTitle className="text-black text-lg">Login</CardTitle>
                       <CardDescription className="text-gray-500 text-sm">
                           Enter your email below to login to your account
                       </CardDescription>
                   </CardHeader>
                   <CardContent>
                       <form id="login" onSubmit={form.handleSubmit(onSubmit)} className="">
                           <FieldGroup className="mb-8">
                              <div className="flex flex-col gap-1">
                                  <Controller name="email" control={form.control} render={({ field, fieldState }) => (
                                      <Field data-invalid={fieldState.invalid}>
                                          <FieldLabel htmlFor="login-form-title" className="m-0">
                                              Email Address
                                          </FieldLabel>

                                          <Input
                                              {...field}
                                              id="email"
                                              aria-invalid={fieldState.invalid}
                                              autoComplete="off"

                                          />

                                          {fieldState.invalid && (
                                              <FieldError errors={[fieldState.error]} />
                                          )}
                                      </Field>
                                  )}
                                  />
                              </div>

                               <div className="flex flex-col gap-2">
                                   <Controller name="password" control={form.control} render={({ field, fieldState }) => (
                                       <Field data-invalid={fieldState.invalid}>
                                           <FieldLabel htmlFor="login-form-title">
                                               Password
                                           </FieldLabel>

                                           <Input
                                               {...field}
                                               id="password"
                                               aria-invalid={fieldState.invalid}
                                               autoComplete="off"

                                           />

                                           {fieldState.invalid && (
                                               <FieldError errors={[fieldState.error]} />
                                           )}
                                       </Field>
                                   )}
                                   />
                               </div>

                           </FieldGroup>

                          <div className="flex flex-col items-center justify-between gap-3">
                              <Button type="submit" className="w-full rounded-md bg-black text-white  text-center" variant="outline">
                                  Log In
                              </Button>

                              <Link
                                  href={route('register')}
                                  className="w-full rounded-md bg-black text-white text-center"
                              >

                                      <Button>
                                          Register
                                      </Button>

                              </Link>
                          </div>
                       </form>
                   </CardContent>
               </Card>
           </div>
       </>

    )








}
