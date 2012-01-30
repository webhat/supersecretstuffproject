<?xml version="1.0" encoding="UTF-8"?>
<schema xmlns="http://purl.oclc.org/dsdl/schematron">
    <pattern>
        <title>Check Example XML</title>
        <rule context="First">
            <title>Check First Element</title>
            <assert test="./@Key">Doesn't contain @Key</assert>
        </rule>
        <rule context="Second">
            <title>Check Second Element</title>
            <assert test="./@Key">Doesn't contain @Key</assert>
            <assert test="./Third/@Ref">Third doesn't contain @Ref</assert>
        </rule>
        <rule context="Third/@Ref[@Ref=//Third/@Key]">
            <title>Check Third Element Reference</title>
            <assert test="./@Ref">Doesn't contain @Ref</assert>
        </rule>
    </pattern>
</schema>