@extends('principal')
@section('contenido')
    <template v-if="menu==0">
        <example-component></example-component>
    </template>

    <template v-if="menu==1">
        <frm-analisis></frm-analisis>
    </template>

    <template v-if="menu==2">
        <h1>Control del paciente en seguimiento</h1>
        {{-- <frm-control></frm-control> --}}
    </template>

    <template v-if="menu==3">
        <frm-paciente></frm-paciente>
    </template>

    <template v-if="menu==4">
        <frm-medicamento></frm-medicamento>
    </template>

    <template v-if="menu==5">
        <frm-sintoma></frm-sintoma>
    </template>

    <template v-if="menu==6">
        <frm-hospital></frm-hospital>
    </template>

    <template v-if="menu==7">
        <h1>Medicos del hospital</h1>
        {{-- <frm-medico></frm-medico> --}}
    </template>

    <template v-if="menu==8">
        <frm-usuario></frm-usuario>
    </template>

    <template v-if="menu==9">
        <frm-rol></frm-rol>
    </template>

    <template v-if="menu==10">
        <h1>Reporte para el historial clinico</h1>
        {{-- <frm-historial></frm-historial> --}}
    </template>

    <template v-if="menu==11">
        <h1>Reporte para el historial diario</h1>
    </template>

    <template v-if="menu==12">
        <h1>Reporte para el historial mensual</h1>
    </template>

    <template v-if="menu==13">
        <h1>Reporte general</h1>
    </template>

    <template v-if="menu==14">
        <h1>Autoevaluacion de personas</h1>
    </template>

    <template v-if="menu==15">
        <h1>¿Qué es el COVID19?</h1>
    </template>

    <template v-if="menu==16">
        <h1>Comunicados Oficiales</h1>
    </template>

    <template v-if="menu==17">
        <h1>Medidas y recomendaciones</h1>
    </template>

    <template v-if="menu==18">
        <h1>Acerca de Santa Cruz Segura</h1>
    </template>
@endsection