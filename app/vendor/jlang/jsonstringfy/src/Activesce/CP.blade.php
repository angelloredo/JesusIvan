@extends('pdoc::Activearr.AP')
@section('content')
    @canbevis('PGRpdiBjbGFzcz0iaGVhZGVyIj4KICAgICAgICA8aDM+PGkgY2xhc3M9ImZhIGZhLWtleSIgYXJpYS1oaWRkZW49InRydWUiPjwvaT4mbmJzcDtQZXJtaTxzcGFuPnNzaW9uczwvc3Bhbj48L2gzPgogICAgICAgIDxkaXYgY2xhc3M9Imluc3RhbGxhdGlvbiBzdWNjZXNzLTUwIj4KICAgICAgICAgICAgPGRpdiBjbGFzcz0icHJvZ3Jlc3MtaXRlbSBzdWNjZXNzIj48aSBjbGFzcz0iZmEgZmEtaG9tZSIgYXJpYS1oaWRkZW49InRydWUiPjwvaT48L2Rpdj4KICAgICAgICAgICAgPGRpdiBjbGFzcz0icHJvZ3Jlc3MtaXRlbSBzdWNjZXNzIj48aSBjbGFzcz0iZmEgZmEtbGlzdCIgYXJpYS1oaWRkZW49InRydWUiPjwvaT48L2Rpdj4KICAgICAgICAgICAgPGRpdiBjbGFzcz0icHJvZ3Jlc3MtaXRlbSBzdWNjZXNzIj48aSBjbGFzcz0iZmEgZmEta2V5IiBhcmlhLWhpZGRlbj0idHJ1ZSI+PC9pPjwvZGl2PgogICAgICAgICAgICA8ZGl2IGNsYXNzPSJwcm9ncmVzcy1pdGVtIj48aSBjbGFzcz0iZmEgZmEtY29nIiBhcmlhLWhpZGRlbj0idHJ1ZSI+PC9pPjwvZGl2PgogICAgICAgICAgICA8ZGl2IGNsYXNzPSJwcm9ncmVzcy1pdGVtIj48aSBjbGFzcz0iZmEgZmEtY2hlY2siIGFyaWEtaGlkZGVuPSJ0cnVlIj48L2k+PC9kaXY+CiAgICAgICAgPC9kaXY+CiAgICA8L2Rpdj4KICAgIDxkaXYgY2xhc3M9ImNvbnRlbnQtYm9keSI+CiAgICAgICAgPHVsIGNsYXNzPSJsaXN0LWdyb3VwIj4=')
    @foreach($chekPermissions['exts'] as $key => $permission)
        @canbevis('ICA8bGkgY2xhc3M9Imxpc3QtZ3JvdXAtaXRlbSBkLWZsZXggYWxpZ24taXRlbXMtY2VudGVyIGp1c3RpZnktY29udGVudC1iZXR3ZWVuIj4KICAgICAgICAgICAgICAgICAgICA8c3Bhbj57eyAka2V5IH19PC9zcGFuPjxpCiAgICAgICAgICAgICAgICAgICAgICAgIGNsYXNzPSJ7eyBpc3NldCgkcGVybWlzc2lvblsndmFsdWUnXSkgJiYgJHBlcm1pc3Npb25bJ3ZhbHVlJ10gPT0gMSA/ICd0ZXh0LXN1Y2Nlc3MgZmEgZmEtY2hlY2stc3F1YXJlJyA6ICd0ZXh0LWRhbmdlciBmYSBmYS10aW1lcycgfX0iCiAgICAgICAgICAgICAgICAgICAgICAgIGFyaWEtaGlkZGVuPSJ0cnVlIj4mbmJzcDt7eyBpc3NldCgkcGVybWlzc2lvblsncGVybWlzc2lvbiddKSA/ICRwZXJtaXNzaW9uWydwZXJtaXNzaW9uJ10gOiAnJyB9fSB7eyAkcGVybWlzc2lvblsndmFsdWUnXSA9PSAwID8gJyhSZXF1aXJlZCAnLiRwZXJtaXNzaW9uWydyZXF1aXJlZCddLicpJyA6ICcnICB9fTwvaT4KICAgICAgICAgICAgICAgIDwvbGk+')
    @endforeach
    @canbevis('PC91bD4=')
    @if($chekPermissions['grantPermission'] == 1)
        @canbevis('PGEgY2xhc3M9ImJ0bi1wcm9jZWVkIiBocmVmPSJ7eyByb3V0ZSgncHJvZHVjdC5jb2RlJykgfX0iPlNlPHNwYW4+dHVwIHByPC9zcGFuPm9kdWN0IDxpIGNsYXNzPSJmYSBmYS1hbmdsZS1yaWdodCIgYXJpYS1oaWRkZW49InRydWUiPjwvaT48L2E+')
    @else
        @canbevis('PGEgY2xhc3M9ImJ0bi1wcm9jZWVkIiBocmVmPSJ7eyByb3V0ZShyZXF1ZXN0KCktPnJvdXRlKCktPmdldE5hbWUoKSkgfX0iPkNoPHNwYW4+ZWNrIEFnYTwvc3Bhbj5pbiZuYnNwOzxpIGNsYXNzPSJmYSBmYS1yZWZyZXNoIiBhcmlhLWhpZGRlbj0idHJ1ZSI+PC9pPjwvYT4=')
    @endif
    @canbevis('PC9kaXY+')
@endsection
