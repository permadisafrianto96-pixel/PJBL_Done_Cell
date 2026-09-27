<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Payment Method - DONE CELL</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>

        body {
            background: #080e1a;
            color: #f0f4ff;
        }

        .method-card {
            transition: all 0.2s ease;
        }

        #qris-content {
            display: grid;
            grid-template-rows: 0fr;
            transition:
                grid-template-rows 0.5s ease,
                opacity 0.4s ease;
            opacity: 0;
        }

        #qris-content.open {
            grid-template-rows: 1fr;
            opacity: 1;
        }

        #qris-arrow {
            transition: transform 0.3s ease;
        }

    </style>

</head>


<body>


<div class="pb-24 md:pb-8">


    <div class="max-w-lg mx-auto px-5 pt-8">


        {{-- HEADER --}}

        <div class="mb-8">

            <h1 class="text-2xl font-bold text-[#f0f4ff] mb-1">
                Payment Method
            </h1>

            <p class="text-sm text-[#8892a4]">
                Select how you want to pay for your repair
            </p>

        </div>


        {{-- REQUEST --}}

        @php

            $request = session('activeRequest');

        @endphp


        {{-- NO ACTIVE REQUEST --}}

        @if (!$request)


            <div class="text-center pt-10">

                <p class="text-[#8892a4]">
                    No active repair awaiting payment.
                </p>

                <a
                    href="/customer/home"
                    class="inline-block mt-4 px-5 py-3 rounded-xl
                           text-[#8892a4]
                           hover:text-[#f0f4ff]
                           transition"
                >
                    Back to Home
                </a>

            </div>


        @else


            {{-- AMOUNT DUE --}}

            <div
                class="rounded-2xl p-5 mb-6"
                style="
                    background:
                    linear-gradient(
                        135deg,
                        rgba(34,211,238,0.08),
                        rgba(34,211,238,0.03)
                    );
                    border: 1px solid rgba(34,211,238,0.2);
                "
            >

                <p
                    class="text-xs text-[#22d3ee]
                           font-semibold uppercase
                           tracking-wider mb-1"
                >
                    Amount Due
                </p>


                <p
                    class="text-3xl font-bold
                           font-mono text-[#f0f4ff]"
                >
                    Rp{{ number_format(
                        $request['fixedPrice'] ?? 0,
                        0,
                        ',',
                        '.'
                    ) }}
                </p>


                <p class="text-xs text-[#8892a4] mt-2">

                    {{ $request['brand'] ?? '' }}

                    {{ $request['model'] ?? '' }}

                    —

                    {{ $request['damageName'] ?? '' }}

                </p>

            </div>



            {{-- PAYMENT METHODS --}}

            <div class="flex flex-col gap-3 mb-6">


                {{-- ========================= --}}
                {{-- QRIS --}}
                {{-- ========================= --}}

                <div
                    id="qris-card"
                    onclick="selectMethod('qris')"
                    class="method-card rounded-2xl p-5 cursor-pointer
                           border border-[#1a2744]
                           bg-[#0f1729]"
                >

                    {{-- QRIS HEADER --}}

                    <div class="flex items-start gap-4">


                        {{-- ICON --}}

                        <div
                            id="qris-icon"
                            class="w-11 h-11 rounded-xl
                                   flex items-center justify-center
                                   shrink-0
                                   bg-[#0c1424]
                                   border border-[#1a2744]
                                   transition-all duration-300"
                        >

                            <span class="text-sm font-bold text-[#22d3ee]">
                                QR
                            </span>

                        </div>


                        {{-- CONTENT --}}

                        <div class="flex-1">

                            <div
                                class="flex items-center
                                       justify-between"
                            >

                                <h3
                                    id="qris-title"
                                    class="font-semibold
                                           text-[#f0f4ff]
                                           transition-colors duration-300"
                                >
                                    QRIS
                                </h3>


                                <div class="flex items-center gap-3">


                                    {{-- CHECK --}}

                                    <span
                                        id="qris-check"
                                        class="hidden text-[#22d3ee]"
                                    >
                                        ✓
                                    </span>


                                    {{-- ARROW --}}

                                    <span
                                        id="qris-arrow"
                                        class="text-[#8892a4]"
                                    >
                                        ↓
                                    </span>

                                </div>

                            </div>


                            <p
                                class="text-sm text-[#8892a4]
                                       mt-1 leading-relaxed"
                            >
                                Scan the QR code to pay
                            </p>


                            <p
                                class="text-xs text-[#4a5568]
                                       mt-2"
                            >
                                QRIS payment
                            </p>

                        </div>

                    </div>



                    {{-- QRIS EXPAND CONTENT --}}

                    <div
                        id="qris-content"
                    >

                        <div class="overflow-hidden">


                            <div
                                class="mt-5 pt-5
                                       border-t border-[#1a2744]
                                       text-center"
                            >

                                <p
                                    class="text-sm
                                           text-[#8892a4]
                                           mb-4"
                                >
                                    Scan this QR code to complete your payment
                                </p>


                                {{-- QRIS IMAGE --}}

                                <div
                                    class="inline-block
                                           p-3
                                           bg-white
                                           rounded-2xl
                                           shadow-lg"
                                >

                                    <img
                                        src="https://i.pinimg.com/736x/f6/fb/c4/f6fbc4deadbcc5287d59fff163191cee.jpg"
                                        alt="QRIS DONE CELL"
                                        class="w-56 h-56
                                               object-contain
                                               rounded-xl"
                                    >

                                </div>


                                <p
                                    class="text-xs
                                           text-[#8892a4]
                                           mt-4"
                                >
                                    After payment, upload your payment proof.
                                </p>

                            </div>

                        </div>

                    </div>

                </div>



                {{-- ========================= --}}
                {{-- BANK TRANSFER --}}
                {{-- ========================= --}}

                <div
                    id="bank-transfer-card"
                    onclick="selectMethod('bank_transfer')"
                    class="method-card rounded-2xl p-5 cursor-pointer
                           border border-[#1a2744]
                           bg-[#0f1729]"
                >

                    <div class="flex items-start gap-4">


                        {{-- ICON --}}

                        <div
                            id="bank-icon"
                            class="w-11 h-11 rounded-xl
                                   flex items-center justify-center
                                   shrink-0
                                   bg-[#0c1424]
                                   border border-[#1a2744]
                                   transition-all duration-300"
                        >

                            <span class="text-xl">
                                🏦
                            </span>

                        </div>


                        {{-- CONTENT --}}

                        <div class="flex-1">


                            <div
                                class="flex items-center
                                       justify-between"
                            >

                                <h3
                                    id="bank-title"
                                    class="font-semibold
                                           text-[#f0f4ff]
                                           transition-colors duration-300"
                                >
                                    Bank Transfer
                                </h3>


                                <span
                                    id="bank-check"
                                    class="hidden text-[#22d3ee]"
                                >
                                    ✓
                                </span>

                            </div>


                            <p
                                class="text-sm text-[#8892a4]
                                       mt-1 leading-relaxed"
                            >
                                Transfer to our bank account and upload
                                your payment proof.
                            </p>


                            <p
                                class="text-xs text-[#4a5568]
                                       mt-2"
                            >
                                Verification within 1–2 hours after upload
                            </p>

                        </div>

                    </div>

                </div>


            </div>



            {{-- CONTINUE --}}

            <button
                id="continue-button"
                onclick="continuePayment()"
                disabled
                class="w-full flex items-center justify-center gap-2
                       px-5 py-3
                       rounded-xl
                       font-semibold
                       bg-[#243356]
                       text-[#4a5568]
                       cursor-not-allowed
                       transition"
            >

                Continue

                <span>
                    →
                </span>

            </button>


            <p
                class="text-xs text-[#4a5568]
                       text-center mt-4"
            >
                Your repair won't begin payment processing
                until you confirm.
            </p>


        @endif


    </div>

</div>



<script>


    let selectedMethod = null;



    function selectMethod(method) {


        selectedMethod = method;


        const qrisCard =
            document.getElementById('qris-card');

        const bankCard =
            document.getElementById('bank-transfer-card');


        const qrisIcon =
            document.getElementById('qris-icon');

        const bankIcon =
            document.getElementById('bank-icon');


        const qrisTitle =
            document.getElementById('qris-title');

        const bankTitle =
            document.getElementById('bank-title');


        const qrisCheck =
            document.getElementById('qris-check');

        const bankCheck =
            document.getElementById('bank-check');


        const qrisContent =
            document.getElementById('qris-content');

        const qrisArrow =
            document.getElementById('qris-arrow');


        const button =
            document.getElementById('continue-button');



        {{-- RESET CARD --}}

        qrisCard.classList.remove(
            'border-[#22d3ee]',
            'bg-[rgba(34,211,238,0.06)]'
        );


        bankCard.classList.remove(
            'border-[#22d3ee]',
            'bg-[rgba(34,211,238,0.06)]'
        );



        {{-- RESET ICON --}}

        qrisIcon.classList.remove(
            'bg-[#22d3ee]'
        );


        bankIcon.classList.remove(
            'bg-[#22d3ee]'
        );



        {{-- RESET TITLE --}}

        qrisTitle.classList.remove(
            'text-[#22d3ee]'
        );


        bankTitle.classList.remove(
            'text-[#22d3ee]'
        );



        {{-- RESET CHECK --}}

        qrisCheck.classList.add(
            'hidden'
        );


        bankCheck.classList.add(
            'hidden'
        );



        {{-- QRIS CLOSED --}}

        qrisContent.classList.remove('open');

        qrisArrow.style.transform =
            'rotate(0deg)';



        {{-- SELECT QRIS --}}

        if (method === 'qris') {


            qrisCard.classList.add(
                'border-[#22d3ee]',
                'bg-[rgba(34,211,238,0.06)]'
            );


            qrisIcon.classList.add(
                'bg-[#22d3ee]'
            );


            qrisTitle.classList.add(
                'text-[#22d3ee]'
            );


            qrisCheck.classList.remove(
                'hidden'
            );


            {{-- OPEN QRIS --}}

            qrisContent.classList.add('open');


            qrisArrow.style.transform =
                'rotate(180deg)';

        }



        {{-- SELECT BANK TRANSFER --}}

        if (method === 'bank_transfer') {


            bankCard.classList.add(
                'border-[#22d3ee]',
                'bg-[rgba(34,211,238,0.06)]'
            );


            bankIcon.classList.add(
                'bg-[#22d3ee]'
            );


            bankTitle.classList.add(
                'text-[#22d3ee]'
            );


            bankCheck.classList.remove(
                'hidden'
            );

        }



        {{-- ENABLE BUTTON --}}

        button.disabled = false;


        button.classList.remove(
            'bg-[#243356]',
            'text-[#4a5568]',
            'cursor-not-allowed'
        );


        button.classList.add(
            'bg-[#22d3ee]',
            'text-[#080e1a]',
            'cursor-pointer'
        );

    }



    function continuePayment() {


        if (!selectedMethod) {

            return;

        }



        if (selectedMethod === 'qris') {

            window.location.href = '/qris';

        }



        if (selectedMethod === 'bank_transfer') {

            window.location.href = '/bank-transfer';

        }

    }


</script>


</body>

</html>