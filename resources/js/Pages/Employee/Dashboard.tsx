import {Link} from "@inertiajs/react";

export default function Dashboard() {
    return (
        <>
            <p>Hello, Employee!</p>

            <Link href={route('logout')} method="post" as="button">
                Log Out
            </Link>
        </>
    )

}
