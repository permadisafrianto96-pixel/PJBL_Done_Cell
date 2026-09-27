<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bank Transfer - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#07111f] text-[#f0f4ff]">

<div class="pb-24 md:pb-8">

    <div class="max-w-lg mx-auto px-5 pt-8">

        {{-- HEADER --}}
        <div class="mb-8">

            <h1 class="text-2xl font-bold text-[#f0f4ff] mb-1">
                Bank Transfer
            </h1>

            <p class="text-sm text-[#8892a4]">
                Transfer to our account and upload your payment proof
            </p>

        </div>


        @php
            $request = session('activeRequest');
        @endphp


        {{-- NO ACTIVE REQUEST --}}
        @if (!$request)

            <div class="text-center pt-10">

                <p class="text-[#8892a4]">
                    No active payment found.
                </p>

                <a
                    href="/customer/home"
                    class="inline-block mt-4 px-5 py-3
                           rounded-xl
                           text-[#22d3ee]
                           hover:underline"
                >
                    Back to Home
                </a>

            </div>

        @else

            {{-- BANK INFORMATION --}}
            <div
                class="bg-[#111b2e]
                       border border-[#1a2744]
                       rounded-2xl
                       p-5
                       mb-5"
            >

                <p
                    class="text-xs
                           font-semibold
                           text-[#8892a4]
                           uppercase
                           tracking-wider
                           mb-4"
                >
                    Transfer To
                </p>


                {{-- BANK --}}
                <div class="flex items-center gap-3 mb-4">

                    <div
                        class="w-11 h-11
                               rounded-xl
                               bg-[rgba(34,211,238,0.1)]
                               flex items-center justify-center
                               text-[#22d3ee]
                               font-bold
                               text-sm"
                    >
                        BCA
                    </div>

                    <div>

                        <p class="font-semibold text-[#f0f4ff]">
                            Done Cell Repair Service
                        </p>

                        <p class="text-sm text-[#8892a4]">
                            Bank Central Asia
                        </p>

                    </div>

                </div>


                {{-- ACCOUNT NUMBER --}}
                <div
                    class="rounded-xl
                           bg-[#0c1424]
                           border border-[#1a2744]
                           px-4 py-3"
                >

                    <p class="text-xs text-[#8892a4] mb-1">
                        Account Number
                    </p>

                    <div class="flex items-center justify-between gap-3">

                        <span
                            class="font-mono
                                   text-[#22d3ee]
                                   text-lg
                                   font-bold
                                   tracking-wider"
                        >
                            1234567890
                        </span>

                        <button
                            type="button"
                            onclick="copyAccountNumber()"
                            class="text-xs
                                   text-[#8892a4]
                                   hover:text-[#22d3ee]
                                   transition-colors"
                        >
                            Copy
                        </button>

                    </div>

                </div>


                {{-- AMOUNT --}}
                <div
                    class="mt-4
                           pt-4
                           border-t border-[#1a2744]
                           flex items-center justify-between"
                >

                    <span class="text-sm text-[#8892a4]">
                        Amount to Transfer
                    </span>

                    <span
                        class="font-bold
                               font-mono
                               text-[#f0f4ff]
                               text-lg"
                    >
                        Rp {{ number_format(
                            $request['fixedPrice'] ?? 0,
                            0,
                            ',',
                            '.'
                        ) }}
                    </span>

                </div>

            </div>


            {{-- REPAIR INFORMATION --}}
            <div
                class="bg-[#111b2e]
                       border border-[#1a2744]
                       rounded-2xl
                       p-5
                       mb-5"
            >

                <p
                    class="text-xs
                           font-semibold
                           text-[#8892a4]
                           uppercase
                           tracking-wider
                           mb-3"
                >
                    Repair Details
                </p>

                <div class="space-y-2 text-sm">

                    <div class="flex justify-between gap-4">

                        <span class="text-[#8892a4]">
                            Brand
                        </span>

                        <span class="font-medium text-right">
                            {{ $request['brand'] ?? '-' }}
                        </span>

                    </div>

                    <div class="flex justify-between gap-4">

                        <span class="text-[#8892a4]">
                            Model
                        </span>

                        <span class="font-medium text-right">
                            {{ $request['model'] ?? '-' }}
                        </span>

                    </div>

                    <div class="flex justify-between gap-4">

                        <span class="text-[#8892a4]">
                            Damage
                        </span>

                        <span class="font-medium text-right">
                            {{ $request['damageName'] ?? '-' }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- PAYMENT PROOF FORM --}}
            <form
                action="/bank-transfer"
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf


                <div
                    class="bg-[#111b2e]
                           border border-[#1a2744]
                           rounded-2xl
                           p-5
                           mb-5"
                >

                    <label
                        class="block
                               text-sm
                               font-semibold
                               text-[#f0f4ff]
                               mb-2"
                    >
                        Upload Payment Proof
                    </label>

                    <p
                        class="text-xs
                               text-[#8892a4]
                               mb-4"
                    >
                        Upload a screenshot or photo showing your successful
                        bank transfer.
                    </p>


                    <input
                        type="file"
                        name="proofFile"
                        accept="image/*"
                        required
                        class="w-full
                               px-4
                               py-3
                               rounded-xl
                               bg-[#0c1424]
                               border border-[#1a2744]
                               text-[#8892a4]
                               text-sm
                               focus:outline-none
                               focus:border-[#22d3ee]"
                    >


                    @error('proofFile')

                        <p class="text-xs text-[#ef4444] mt-2">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- SUBMIT --}}
                <button
                    type="submit"
                    class="w-full
                           py-3.5
                           rounded-xl
                           bg-[#22d3ee]
                           text-[#07111f]
                           font-bold
                           hover:bg-[#67e8f9]
                           transition"
                >
                    Submit Payment Proof
                </button>

            </form>


            <p
                class="text-xs
                       text-[#4a5568]
                       text-center
                       mt-4"
            >
                Your payment will be reviewed by our staff.
            </p>

        @endif

    </div>

</div>


<script>

    function copyAccountNumber() {

        const accountNumber = '1234567890';

        navigator.clipboard.writeText(accountNumber);

        alert('Account number copied.');

    }

</script>

</body>

</html>