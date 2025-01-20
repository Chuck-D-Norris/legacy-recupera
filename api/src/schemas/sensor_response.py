from pydantic import BaseModel
from datetime import datetime
from typing import List, Optional


class SensorHistoryResponse(BaseModel):
    id: int
    temperature: float
    humidity: float
    inclination: float
    created_at: datetime

    class Config:
        orm_mode = True


class SensorResponse(BaseModel):
    id: int
    histories: List[SensorHistoryResponse] = []

    class Config:
        orm_mode = True
